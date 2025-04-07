<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Charges;
use App\Classes\MainClass;
use App\Models\PlansEpargne;
use App\Models\System_client;
use App\Models\DetteFinanciere;
use App\Models\DetteFournisseur;
use App\Classes\CalculeRevenuApi;
use App\Classes\CalculationsClass;
use Illuminate\Support\Facades\Log;
use App\Classes\CoteCalculationClass;

class CoteController extends Controller
{

    /**
     * Get the specified company cote.
     */

    public function getUser()
    {
        $users = User::select('name', 'last_stname', 'user_name', 'email', 'phone_number', 'system_client_id', 'created_at')
            ->get()
            ->map(function ($user) {
                $user->mois_depuis_creation = (int) Carbon::parse($user->created_at)->diffInMonths(now());
                return $user;
            });

        // Récupération du nombre de mois depuis la création pour la solvabilité
        $months = $users->isNotEmpty() ? $users->first()->mois_depuis_creation : 0;

        // Retour de la réponse JSON avec les utilisateurs, la solvabilité et les tendances
        return response()->json([
            'users' => $users,
        ]);
    }
    public function getCote($entrepriseId, $months)
    {
        try {
            $entreprise =  System_client::where('id', $entrepriseId)->exists();
        } catch (Exception) {
            $entreprise = false;
        }

        if ($months < 3) {
            return response()->json("La limite du nombre de mois est de 3");
        }

        if ($entreprise) {

            // Appel de la fonction de solvabilité avec le calcul des tendances
            $solvabiliteResult = CoteCalculationClass::mesureDeSolvabiliteEntreprise($months);

            $grade = $solvabiliteResult['grade']; // grade

            // Retour de la réponse JSON avec les utilisateurs, la solvabilité et les tendances
            return response()->json([

                'grade' => $grade
            ]);
        } else {
            return response()->json(['error' => "Données non conformes..."]);
        }
    }

    public function getProvisions($entrepriseId)
    {
        try {
            Log::info("🚀 [START] getProvisions", ['entreprise_id' => $entrepriseId]);

            $provisions = [];
            $today = Carbon::today()->format('Y-m-d');
            Log::info("📅 Date actuelle : $today");

            // 🔍 Récupération de l'entreprise
            $entreprise = System_client::find($entrepriseId);
            if (!$entreprise) {
                Log::warning("❌ Entreprise introuvable", ['entreprise_id' => $entrepriseId]);
                throw new Exception("Entreprise non trouvée");
            }
            $systemId = $entreprise->id;
            Log::info("✅ Entreprise trouvée", ['system_id' => $systemId]);

            $tPortions = 0.0;
            $tPortionsProv = 0.0;

            // 🧾 Dettes fournisseurs
            Log::info("🔍 Récupération des dettes fournisseurs...");
            $detteFournisseurs = DetteFournisseur::whereHas('approvisionnementSystemProduit.produitsBrut', function ($query) use ($systemId) {
                $query->where('system_client_id', $systemId);
            })
                ->whereRaw('montant > montant_paye')
                ->whereDate('date_effet', '<', $today)
                ->with([
                    'approvisionnementSystemProduit.approvisionnement.ligneFournisseur.fournisseur',
                    'provision',
                    'approvisionnementSystemProduit.produitsBrut'
                ])
                ->get();
            Log::info("📦 Dettes fournisseurs récupérées", ['count' => $detteFournisseurs->count()]);

            // 🏦 Dettes bancaires
            Log::info("🔍 Récupération des dettes bancaires...");
            $detteBancaires = DetteFinanciere::where('system_client_id', $systemId)
                ->whereRaw('(montant_emprunte + montant_interet) > montant_paye')
                ->whereDate('date_effet', '<', $today)
                ->whereHas('banque')
                ->with('banque')
                ->with('provision')
                ->get();
            Log::info("🏛️ Dettes bancaires récupérées", ['count' => $detteBancaires->count()]);

            // 💸 Autres dettes financières
            Log::info("🔍 Récupération des autres dettes financières...");
            $autresDetteFinancieres = DetteFinanciere::where('system_client_id', $systemId)
                ->whereRaw('(montant_emprunte + montant_interet) > montant_paye')
                ->whereDate('date_effet', '<', $today)
                ->whereDoesntHave('banque')
                ->with('provision')
                ->get();
            Log::info("💼 Autres dettes récupérées", ['count' => $autresDetteFinancieres->count()]);

            // 📊 Charges fixes
            Log::info("🔍 Récupération des charges...");
            $charges = Charges::where('system_client_id', $systemId)
                ->where('type', '!=', 'Variable')
                ->with('provision')
                ->get();
            Log::info("📈 Charges récupérées", ['count' => $charges->count()]);

            // 🐖 Epargnes
            Log::info("🔍 Récupération des épargnes...");
            $epargnes = PlansEpargne::where('system_client_id', $systemId)
                ->with('provision')
                ->get();
            Log::info("💰 Epargnes récupérées", ['count' => $epargnes->count()]);

            // 📈 Calcul des revenus
            Log::info("🧮 Calcul des revenus...");
            $revenus = CalculeRevenuApi::chiffreAffaire($today, $today, $systemId) - CalculeRevenuApi::depensesRegleesSurPlace($today, $today, $systemId);
            Log::info("💵 Revenus nets : {$revenus}");

            // 🧮 Calcul du total des portions
            foreach ($detteFournisseurs as $df) {
                $portion = $df->portion_journaliere ?? 0;
                $tPortions += $portion;
                Log::info("➕ Portion dette fournisseur", ['id' => $df->id, 'portion' => $portion]);
            }

            foreach ($detteBancaires as $db) {
                $portion = $db->portion_journaliere ?? 0;
                $tPortions += $portion;
                Log::info("➕ Portion dette bancaire", ['id' => $db->id, 'portion' => $portion]);
            }

            foreach ($autresDetteFinancieres as $daf) {
                $portion = $daf->portion_journaliere ?? 0;
                $tPortions += $portion;
                Log::info("➕ Portion autre dette", ['id' => $daf->id, 'portion' => $portion]);
            }

            foreach ($charges as $c) {
                $portion = $c->portion_journaliere ?? 0;
                $tPortions += $portion;
                Log::info("➕ Portion charge", ['id' => $c->id, 'portion' => $portion]);
            }

            foreach ($epargnes as $ep) {
                $portion = $ep->montant ?? 0;
                $tPortions += $portion;
                Log::info("➕ Portion épargne", ['id' => $ep->id, 'montant' => $portion]);
            }

            Log::info("📊 Total des portions calculé", ['tPortions' => $tPortions]);

            // 📤 Répartition des provisions
            foreach ($detteFournisseurs as $df) {
                $allocation = min($df->portion_journaliere ?? 0, $tPortions > 0 ? ($df->portion_journaliere * $revenus) / $tPortions : 0);
                $tPortionsProv += $allocation;
                Log::info("💼 Allocation provision dette fournisseur", ['id' => $df->id, 'allocation' => $allocation]);
            }

            foreach ($detteBancaires as $db) {
                $allocation = min($db->portion_journaliere ?? 0, $tPortions > 0 ? ($db->portion_journaliere * $revenus) / $tPortions : 0);
                $tPortionsProv += $allocation;
                Log::info("🏦 Allocation provision dette bancaire", ['id' => $db->id, 'allocation' => $allocation]);
            }

            foreach ($autresDetteFinancieres as $daf) {
                $allocation = min($daf->portion_journaliere ?? 0, $tPortions > 0 ? ($daf->portion_journaliere * $revenus) / $tPortions : 0);
                $tPortionsProv += $allocation;
                Log::info("📉 Allocation provision autre dette", ['id' => $daf->id, 'allocation' => $allocation]);
            }

            foreach ($charges as $c) {
                $allocation = min($c->portion_journaliere ?? 0, $tPortions > 0 ? ($c->portion_journaliere * $revenus) / $tPortions : 0);
                $tPortionsProv += $allocation;
                Log::info("📊 Allocation provision charge", ['id' => $c->id, 'allocation' => $allocation]);
            }

            foreach ($epargnes as $ep) {
                $allocation = min($ep->montant ?? 0, $tPortions > 0 ? ($ep->montant * $revenus) / $tPortions : 0);
                $tPortionsProv += $allocation;
                Log::info("🐷 Allocation provision épargne", ['id' => $ep->id, 'allocation' => $allocation, 'monatant ep' => $ep->montant]);
            }

            Log::info("✅ [FIN] getProvisions terminé avec succès", [
                'revenus' => $revenus,
                'tPortions' => $tPortions,
                'tPortionsProv' => $tPortionsProv
            ]);

            return [
                "revenus" => $revenus,
                "prostion" => $tPortions,
                "revenu_alloue" => $tPortionsProv,
                "user_id" => $systemId
            ];
        } catch (\Exception $e) {
            Log::error("❌ Erreur dans getProvisions", [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                "error" => $e->getMessage()
            ];
        }
    }
}
