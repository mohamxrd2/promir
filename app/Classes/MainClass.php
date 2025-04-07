<?php

namespace App\Classes;

use Carbon\Carbon;
use App\Models\Charges;
use App\Models\Payement;
use Illuminate\Http\Request;
use App\Models\System_client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MainClass
{



    public function __construct() {}
    public static function getSystemId()
    {
        $chaine = request()->getRequestUri();
        if (str_contains($chaine, '/api/cote/')) {
            preg_match('/api\/cote\/(\d+)\/(\d+)/', $chaine, $matches);
            if (!empty($matches)) {
                $entreprise = $matches[1];
            }
            return $entreprise;
        } else {
            $user = Auth::user();
            return $user && $user->system_client ? $user->system_client->id : null;
        }
    }

    public static function getAllSystemIds()
    {
        $systemId = self::getSystemId(); // Récupérer l'ID du system_client actuel

        if ($systemId) {
            return System_client::where('id', $systemId)->pluck('id');
        }

        return System_client::pluck('id'); // Retourne tous les IDs si aucun ID spécifique trouvé
    }






    public static function generateReference($prefix, $modelClass)
    {
        if (!class_exists($modelClass) || !is_subclass_of($modelClass, 'Illuminate\Database\Eloquent\Model')) {
            throw new \Exception("Invalid model class");
        }


        do {
            $now = Carbon::now();
            $milliseconds = $now->format('u');
            $reference = $prefix . str_pad(MainClass::getSystemId(), 2, '0', STR_PAD_LEFT) . $milliseconds;
        } while ($modelClass::where('reference', $reference)->exists());
        return $reference;
    }

    public static function calculerCoutPortionUnitaire($coutqte_stck, $qte_stck_satic_apres_appro, $nbrPiecesParQqte_stck, $nbrPortionsParPiece)
    {
        $coutPortion = $coutqte_stck / ($nbrPiecesParQqte_stck * $nbrPortionsParPiece * $qte_stck_satic_apres_appro);
        return $coutPortion;
    }


    private function renderMessages()
    {
        return [
            'type.required' => 'Le champ "Type" est requis.',
            'type.string' => 'Le champ "Type" doit être une chaîne de caractères.',
            'type.max' => 'Le champ "Type" ne doit pas dépasser :max caractères.',

            'nom.required' => 'Le champ "Nom" est requis.',
            'nom.string' => 'Le champ "Nom" doit être une chaîne de caractères.',
            'nom.max' => 'Le champ "Nom" ne doit pas dépasser :max caractères.',

            'adresse.required' => 'Le champ "Adresse" est requis.',
            'adresse.string' => 'Le champ "Adresse" doit être une chaîne de caractères.',
            'adresse.max' => 'Le champ "Adresse" ne doit pas dépasser :max caractères.',

            'email.required' => 'Le champ "Email" est requis.',
            'email.string' => 'Le champ "Email" doit être une chaîne de caractères.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'email.max' => 'Le champ "Email" ne doit pas dépasser :max caractères.',
            'email.unique' => 'Cet email est déjà utilisé.',

            'phone.required' => 'Le champ "Téléphone" est requis.',
            'phone.string' => 'Le champ "Téléphone" doit être une chaîne de caractères.',
            'phone.max' => 'Le champ "Téléphone" ne doit pas dépasser :max caractères.',
            'phone.unique' => 'Ce numéro de téléphone est déjà utilisé.',

            'seconde_phone.required' => 'Le champ "Téléphone" est requis.',
            'seconde_phone.string' => 'Le champ "Téléphone" doit être une chaîne de caractères.',
            'seconde_phone.max' => 'Le champ "Téléphone" ne doit pas dépasser :max caractères.',
            'seconde_phone.unique' => 'Ce numéro de téléphone est déjà utilisé.',

            'region.required' => 'Le champ "Region" est requis.',
            'region.string' => 'Le champ "Region" doit être une chaîne de caractères.',
            'region.max' => 'Le champ "Region" ne doit pas dépasser :max caractères.',

            'departement.required' => 'Le champ "Departement" est requis.',
            'departement.string' => 'Le champ "Departement" doit être une chaîne de caractères.',
            'departement.max' => 'Le champ "Departement" ne doit pas dépasser :max caractères.',

            'localite.required' => 'La localité est requise.',
            'localite.string' => 'Le localité doit être une chaîne de caractères.',

            'pays.required' => 'Le champ "Pays" est requis.',
            'pays.string' => 'Le pays doit être une chaîne de caractères.',
        ];
    }
    public static function translateDaysToEnglish(array $frenchDays)
    {
        $daysMapping = [
            'lundi' => 'monday',
            'mardi' => 'tuesday',
            'mercredi' => 'wednesday',
            'jeudi' => 'thursday',
            'vendredi' => 'friday',
            'samedi' => 'saturday',
            'dimanche' => 'sunday',
        ];
        return array_map(function ($day) use ($daysMapping) {
            return $daysMapping[strtolower($day)] ?? strtolower($day);
        }, $frenchDays);
    }




    public static function getNumberOfWorkingDaysInThisMonth()
    {
        $jours_de_repos = System_client::findOrFail(MainClass::getSystemId())->jours_de_repos->toArray();
        $nonWorkingDays = MainClass::translateDaysToEnglish(array_unique(array_column($jours_de_repos, 'libelle')));
        $moisEncours = Carbon::now()->month;
        $anneeEncours = Carbon::now()->year;
        $joursDuMois = Carbon::now()->daysInMonth();
        $joursTravailles = 0;
        for ($day = 1; $day <= $joursDuMois; $day++) {
            $date = Carbon::create($anneeEncours, $moisEncours, $day);
            $jourEncours = strtolower($date->format('l'));
            if (!in_array($jourEncours, $nonWorkingDays)) {
                $joursTravailles++;
            }
        }
        return $joursTravailles;
    }
    public static function gererPreuvesPayement(Request $request, Payement $payement)
    {
        if ($request->filled('reference')) {
            $payement->reference = $request->reference;
            $payement->update();
        }

        if ($request->hasFile('fichier_joint')) {
            $filePath = $request->file('fichier_joint')->store('payementFiles', 'public');
            $payement = Payement::find($payement->id);
            $payement->fichier_joint =  $filePath;
            $payement->update();
        }
    }

    public static function updateDateEcheanceCharge()
    {
        $charges = Charges::all();
        foreach ($charges as $charge) {
            $dateEcheance = Carbon::parse($charge->date_echeance);
            //voir si l'on a depassé ou si l'on est à la fin de la périodicité de la charge
            if ($dateEcheance->lessThanOrEqualTo(Carbon::now())) {
                preg_match('/\d+/', $charge->periodicite, $matches);
                $nombre_mois = (int) $matches[0] ?? 0;
                if ($nombre_mois > 0) {
                    $nouvelleDateEffet = $dateEcheance;
                    $nouvelleDateEcheance = $dateEcheance->addMonths($nombre_mois);
                    $charge->update(['date_effet' => $nouvelleDateEffet, 'date_echeance' => $nouvelleDateEcheance]);
                }
            }
        }
        return 0;
    }


    public static function modelsWithoutSubModelDeletor($id, Model $model)
    {
        try {
            $m = $model::findOrFail($id);
            $m->delete();
            return true;
        } catch (ModelNotFoundException $e) {
            return false;
        }
    }
}
// $formattedDate = $now->format('YmdHis');
// $reference = $prefix. $formattedDate . str_pad($id, 2, '0', STR_PAD_LEFT) . $milliseconds;
