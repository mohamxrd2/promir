<?php

namespace App\Http\Controllers;

use App\Classes\MainClass;
use App\Models\modaliteEchellonneeDetteClient;
use App\Models\modalitePeriodiqueDetteClient;
use App\Models\modalitePeriodiqueDetteFournisseur;
use App\Models\Personnel;
use App\Models\Reglement;
use App\Models\Tresorerie;
use App\Models\TresorerieMois;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use InvalidArgumentException;

class CompteTresorerieController extends Controller
{
   // 

   public function tresorerieIndex () {
        $now = Carbon::now()->format('Y');
        $modesPeriodiquesVentes = modalitePeriodiqueDetteClient::where('status', 'En cours')->with('dette')->get();
        $modesPeriodiquesAchats = modalitePeriodiqueDetteFournisseur::where('status', 'En cours')->with('dette')->get();
        $modesEchellonnesVentes = modaliteEchellonneeDetteClient::where('status', 'En cours')->get();
        $modesEchellonnesAchats = modaliteEchellonneeDetteClient::where('status', 'En cours')->get();


        $somme_vente1 = $this->cumulerAnticipations($modesPeriodiquesVentes->toArray());
        $somme_achat1 = $this->cumulerAnticipations($modesPeriodiquesAchats->toArray());


        $salaire = Personnel::with('contrat')->get()->sum('salaire_mensuel');

        $totalVente = $this->cumulParMois($somme_vente1, $this->ventesModaliteEchellonnees($modesEchellonnesVentes));
        $totalAchat = $this->cumulParMois($somme_achat1, $this->ventesModaliteEchellonnees($modesEchellonnesAchats));
      
        
        $immobilisations = Reglement::selectRaw('annee, mois, SUM(montant) as total_montant')
        ->whereHas('investissement', function($query) {
            $query->whereIn('libelle', [
                'Machine', 'Outillage', 'Equipement', 'Bâtiment', 'Usine', 'Autre Construction', 'Aménagement', 
                'Micro-ordinateurs', 'Matériel de transport', 
                'Matériel de bureau', 'Autre materiel', 'Terrain', 
                "Œuvres d'art", 'Installations techniques'
            ]);
        })
        ->where('annee', "2001")
        ->groupBy('annee', 'mois')
        ->orderBy('mois')
        ->get()->toArray();

        $montantsImmobilisationsParMois = array_fill(1, 12, 0);

// Remplir le tableau avec les montants correspondants
        foreach ($immobilisations as $entry) {
            $mois = (int) $entry['mois'];
            $montantsImmobilisationsParMois[$mois] = $entry['total_montant'];
        }

        return view("etats.compte_de_tresorerie", compact(var_name: ["now", "totalVente", "totalAchat", "salaire" , "montantsImmobilisationsParMois"]));
    }


    public function storeCompteTresorerie(Request $request) {
        $now = Carbon::now();
        try {
            $tresorerie = Tresorerie::where('system_client_id', MainClass::getSystemId())
                                    ->where('annee', $now->format('Y'))
                                    ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $tresorerie = Tresorerie::create([
                "system_client_id" => MainClass::getSystemId(),
                "annee" => $now->format('Y'),
            ]);
        }
    
        $mois = 1;
        foreach ($request->donnees as $cle => $colone) {
            if ($cle > 0) {
                if ($tresorerie->contenuMois->count() == 0) {
                    // Création d'un nouveau contenu si aucun contenu existant
                    TresorerieMois::create([
                        'mois' => $mois,
                        'apports_en_capital' => $colone[0],
                        'apports_en_compte_courant' => $colone[1],
                        'emprunts' => $colone[2],
                        'ventes_marchandises' => $colone[3],
                        'remboursements_du_credit_tva' => $colone[5],
                        'marge_encaissements' => 0,
                        'immobilsations_coprporelles' => $colone[7],
                        'echenaces_emprunts' => $colone[9],
                        'achats_marchandises_effectues' => $colone[10],
                        'fournitures' => $colone[12],
                        'consommables' => $colone[13],
                        'services_exterieurs' => $colone[14],
                        'impot_etat' => $colone[16],
                        'salaires_nets' => $colone[17],
                        'charges_sociales' => $colone[18],
                        'tva_a_payer' => $colone[20],
                        'solde_precedent' => $colone[22],
                        'marge_decaissements' => 0,
                        'variation_tresorerie' => $colone[23],
                        'tresorerie_id' => $tresorerie->id,
                    ]);
                } else {


                    // Mise à jour des contenus existants
                    $contenuMois = $tresorerie->contenuMois->where('mois', $mois)->first();
                    if ($contenuMois) {
                        $contenuMois->update([
                            'apports_en_capital' => $colone[0],
                            'apports_en_compte_courant' => $colone[1],
                            'emprunts' => $colone[2],
                            'ventes_marchandises' => $colone[3],
                            'remboursements_du_credit_tva' => $colone[5],
                            'marge_encaissements' => 0,
                            'immobilsations_coprporelles' => $colone[7],
                            'echenaces_emprunts' => $colone[9],
                            'achats_marchandises_effectues' => $colone[10],
                            'fournitures' => $colone[12],
                            'consommables' => $colone[13],
                            'services_exterieurs' => $colone[14],
                            'impot_etat' => $colone[16],
                            'salaires_nets' => $colone[17],
                            'charges_sociales' => $colone[18],
                            'tva_a_payer' => $colone[20],
                            'solde_precedent' => $colone[22],
                            'marge_decaissements' => 0,
                            'variation_tresorerie' => $colone[23],
                        ]);
                    }
                }
                $mois++;
            }
        }
    
        return response()->json(["ok" => true]);
    }
    






   

    


    public function ventesModaliteEchellonnees(Collection $modesEchellonnes) {
       
        $montantsParMois = [];
    
        foreach ($modesEchellonnes as $mode) {
            $dateReglement = Carbon::parse($mode->date_reglement);
    
            if ($dateReglement->format('Y') == Carbon::now()->format('Y')) {
                $mois = $dateReglement->format('Y-m');
                if (!isset($montantsParMois[$mois])) {
                    $montantsParMois[$mois] = 0;
                }
                $montantsParMois[$mois] += $mode->montant;
            }
        }
    
        ksort($montantsParMois);
        return $montantsParMois;
    }


    private function cumulParMois($tableau1, $tableau2) {
        $resultat = [];
    
        $clésFusionnées = array_unique(array_merge(array_keys($tableau1), array_keys($tableau2)));
    
        foreach ($clésFusionnées as $clé) {
            $valeur1 = $tableau1[$clé] ?? 0; 
            $valeur2 = $tableau2[$clé] ?? 0;
            $resultat[$clé] = $valeur1 + $valeur2;
        }
    
        ksort($resultat);
    
        return $resultat;
    }
    

    private function cumulerAnticipations(array $instancesModePayement) {
        $cumulAnticipations = [];
    
        foreach ($instancesModePayement as $modePayement) {

            $anticipations = $this->calculerAnticipations($modePayement);

            foreach ($anticipations as $mois => $montant) {
                if (!isset($cumulAnticipations[$mois])) {
                    $cumulAnticipations[$mois] = 0; // Initialiser si le mois n'existe pas encore
                }
                $cumulAnticipations[$mois] += $montant; // Ajouter le montant pour le mois
            }
        }
    
        // Trier les mois par ordre chronologique
        ksort($cumulAnticipations);
    
        return $cumulAnticipations;
    }

    private function calculerAnticipations($modePayement){
        $periodicite = $modePayement["periodicite_payement"];
        $montant = $modePayement["montant"];
        $montantTotal = $modePayement["dette"] ? $modePayement["dette"]["montant"] : 0;
        $dateEffet = Carbon::parse( $modePayement["dette"] ? $modePayement["dette"]["date_effet"]: 0);
        
        $resultats = [];
        $dateCourante = $dateEffet;
        $dateFin = Carbon::now()->endOfYear();
        $cumul = 0;

        while ($dateCourante <= $dateFin && $cumul < $montantTotal) {
           $mois = $dateCourante->format('Y-m');
            if (!isset($resultats[$mois])) {
                $resultats[$mois] = 0;
            }

            $reste = $montantTotal - $cumul;
            $paiement = min($montant, $reste);

            $resultats[$mois] += $paiement;
            $cumul += $paiement;

            if ($cumul >= $montantTotal) {
                break;
            }

           
            switch ($periodicite) {
                case 'jour':
                    $dateCourante->addDay(); 
                    break;
                case 'semaine':
                    $dateCourante->addWeek(); 
                    break;
                case 'mois':
                    $dateCourante->addMonth(); 
                    break;
                case 'trimestre':
                    $dateCourante->addMonths(3);
                    break;
                case 'semestre':
                    $dateCourante->addMonths(6);
                    break;
                case 'an':
                    $dateCourante->addYear(); 
                    break;
                default:
                    throw new InvalidArgumentException("Périodicité invalide : $periodicite");
            }
                        
        }


        return $resultats;
    }
}
