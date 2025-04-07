<?php
namespace App\Classes;
use App\Classes\MainClass;
use App\Models\Charges;
use App\Models\Depense;
use App\Models\DetteFinanciere;
use App\Models\detteFournisseur;
use App\Models\Personnel;
use App\Models\PrestationService;
use App\Models\Production;
use App\Models\System_client;
use App\Models\Ventes;
use Carbon\Carbon;


class CalculeRevenuApi {
    public static $precision = 4;
    public function __construct() {
        
    }
    
    public static function chiffreAffaire($dateDebut, $dateFin, $userId){
        $systemId = $userId;
        $montantVentes = Ventes::whereHas('lignClientSystem.systemClient', function ($query) use ($systemId) {
            $query->where('id', $systemId);
        })
        ->with('lignesVente')
        ->whereDoesntHave('lignesVente.avanceClient')
        ->whereDate('created_at', '>=', $dateDebut)
        ->whereDate('created_at', '<=', $dateFin)
        ->get()
        ->sum('montant_vente');


        $montantPrestations = PrestationService::whereHas('service', function ($query) use ($systemId) {
            $query->where('system_client_id', $systemId);
        })
        ->whereDate('created_at', '>=', $dateDebut)
        ->whereDate('created_at', '<=', $dateFin)
        ->whereHas('payement')
        ->with('payement')
        ->get()
        ->sum('montant_facture');
        return round($montantVentes + $montantPrestations, 4);
    }


    public static function resultatNet($startDate, $endDate){
        //Résultat Net = Chiffre d’Affaires − Total des Charges
        $chiffre_affaires = CalculationsClass::chiffreAffaire($startDate, $endDate);
        $charges_directes = CalculationsClass::chargesDirectes($startDate, $endDate);
        $charges_indirectes = CalculationsClass::portionJournaliereChagesIndirectes() * 
            CalculationsClass::calculateWorkingDaysBetweenDates($startDate, $endDate);
        
        return $chiffre_affaires - ($charges_directes + $charges_indirectes);
    }
    
    public static function rentabiliteEconomique ($startDate, $endDate){
        // Rentabilité économique = Résultat net d’exploitation / Capitaux investis 
        $resultat_net = (float) CalculationsClass::resultatNet($startDate, $endDate);
        $chiffre_affaires = CalculationsClass::chiffreAffaire($startDate, $endDate);
        return  $chiffre_affaires > 0 ? round( $resultat_net / $chiffre_affaires, CalculationsClass::$precision) : 0;
    } 
    
    public static function rentabiliteFinanciere ($startDate, $endDate){
        //Rentabilité financière = Résultat Net / Capitaux propres 
        $resultat_net = (float) CalculationsClass::resultatNet($startDate, $endDate);
        $capital_propre = (float) System_client::find(MainClass::getSystemId(), "capital_social")->capital_social;
        return  $capital_propre > 0 ? round( $resultat_net / $capital_propre, CalculationsClass::$precision) : 0;
    }

    public static function nombreEmpoyes(){
        return Personnel::where('system_client_id', MainClass::getSystemId())->count();
    }
    

    public static function productivitePersonnel($dateDebut, $dateFin){
        $nombre_empoyes = CalculationsClass::nombreEmpoyes();
        return  $nombre_empoyes > 0 ? round(CalculationsClass::chiffreAffaire($dateDebut, $dateFin) / $nombre_empoyes, 4) : 0;
    }

    public static function chargesDirectesProduction($dateDebut, $dateFin){
        $systemId = MainClass::getSystemId();

        $charges = Production::whereHas('produitsBruts', function($query) use ($systemId) {
                $query->where('system_client_id', $systemId);
            })
            ->whereDate('created_at', '>=', $dateDebut)
            ->whereDate('created_at', '<=', $dateFin)
            ->with(['produitsBruts'])
            ->get()
            ->sum(function($production) {
                return $production->cout_produits;
            });
        return round($charges,CalculationsClass::$precision);
    }
    public static function chargesDirectesPrestation($dateDebut, $dateFin){
        $systemId = MainClass::getSystemId();
        $charges = PrestationService::whereHas('client', function($query) use ($systemId) {
                $query->where('system_client_id', $systemId);
            })
            ->whereDate('created_at', '>=', $dateDebut)
            ->whereDate('created_at', '<=', $dateFin)
            ->with('produits')
            ->with('personnel.contrat')
            ->get()
            ->sum(function($prestation) {
                return $prestation->cout_personnel + $prestation->cout_produits;
            });

        return round($charges, CalculationsClass::$precision);
    }

    public static function chargesDirectes($dateDebut, $dateFin){
        $charges_directes = CalculationsClass::chargesDirectesPrestation($dateDebut, $dateFin) + CalculationsClass::chargesDirectesProduction($dateDebut, $dateFin);
        return round($charges_directes, CalculationsClass::$precision);
    }
    
    
    public static function chargesDirectesExploitation($dateDebut, $dateFin){
        $autres_charges = CalculationsClass::portionJournaliereAutreChages() * 
            CalculationsClass::calculateWorkingDaysBetweenDates($dateDebut, $dateFin);
        $charges_directes = CalculationsClass::chargesDirectes($dateDebut, $dateFin);

        return round($charges_directes + $autres_charges, CalculationsClass::$precision);
    }


    public static function poidsChargesDirectesExploitation($startDate, $endDate) {
        $charges_directes_exploitation = CalculationsClass::chargesDirectesExploitation($startDate, $endDate);
        $charges_directes = CalculationsClass::chargesDirectes($startDate, $endDate);
        $charges_indirectes = CalculationsClass::portionJournaliereChagesIndirectes() * CalculationsClass::calculateWorkingDaysBetweenDates($startDate, $endDate);
        $total_charges = $charges_directes + $charges_indirectes;
        
        $poids = $total_charges != 0 ? ($charges_directes_exploitation / $total_charges) * 100 : 0;
        
        return round($poids, CalculationsClass::$precision);
    }
    public static function poidsChargesDirectesProduction($startDate, $endDate) {
        $charges_directes_production = CalculationsClass::chargesDirectesProduction($startDate, $endDate);
        $charges_directes = CalculationsClass::chargesDirectes($startDate, $endDate);
        $charges_indirectes = CalculationsClass::portionJournaliereChagesIndirectes() * CalculationsClass::calculateWorkingDaysBetweenDates($startDate, $endDate);
        $total_charges = $charges_directes + $charges_indirectes;
        
        $poids = $total_charges != 0 ? ($charges_directes_production / $total_charges) * 100 : 0;
        
        return round($poids, CalculationsClass::$precision);
    }
    
    public static function poidsChargesIndirectesProduction($startDate, $endDate) {
        $charges_directes = CalculationsClass::chargesDirectes($startDate, $endDate);
        $charges_indirectes = CalculationsClass::portionJournaliereChagesIndirectes() * CalculationsClass::calculateWorkingDaysBetweenDates($startDate, $endDate);
        $total_charges = $charges_directes + $charges_indirectes;
        
        $poids = $total_charges != 0 ? ($charges_indirectes / $total_charges) * 100 : 0;
        
        return round($poids, CalculationsClass::$precision);
    }
    
    
    public static function portionJournaliereDetteFournisseur(){
        return round(detteFournisseur::whereHas('approvisionnementSystemProduit.produitsBrut', function($query){
            $query->where('system_client_id', MainClass::getSystemId());
        })
        ->get()
        ->sum('portion_journaliere'),CalculationsClass::$precision);
    }
    
    public static function portionJournaliereDetteFinanciere(){
        return round(DetteFinanciere::where('system_client_id', MainClass::getSystemId())->get()->sum('portion_journaliere'),CalculationsClass::$precision);
    }
    
    public static function portionJournaliereSalaires(){
        return CalculationsClass::portionJournaliere(Personnel::where('system_client_id', MainClass::getSystemId())
            ->with('contrat')->get()
            ->sum('salaire_mensuel')
        );
    }
    
    public static function portionJournaliereAutreChages(){
        return Charges::where('system_client_id', MainClass::getSystemId())->where('libelle', "!=", 'Loyer')->where('libelle', "!=", 'Salaires')->where('libelle', "!=", 'Impôts (autres que l’impôt sur les bénéfices)')->where('libelle', "!=", 'Autres taxes communales')->where('libelle', "!=", 'TVA')->where('libelle', "!=", 'Redevances')->where('libelle', "!=", 'Autres taxes de l\'État')
            ->get()
            ->sum('portion_journaliere');
    }
    
    public static function portionJournaliereChargeSurLoyer(){
        return Charges::where('libelle', 'Loyer')->where('system_client_id', MainClass::getSystemId())
            ->get()
            ->sum('portion_journaliere');
    }
    
    public static function portionJournaliereChargeSurImpot(){
        $charges = Charges::where('libelle', 'Impôts (autres que l’impôt sur les bénéfices)')->orWhere('libelle', 'Autres taxes communales')->orWhere('libelle', 'TVA')->orWhere('libelle', 'Redevances')->orWhere('libelle', 'Autres taxes de l\'État');
         return $charges->where('system_client_id', MainClass::getSystemId())
                ->get()
                ->sum('portion_journaliere');
    }
    
    public static function depenses($dateDebut, $dateFin){
        return Depense::where('system_client_id', MainClass::getSystemId())
            ->whereDate('created_at', '>=', $dateDebut)
            ->whereDate('created_at', '<=', $dateFin)
            ->get()
            ->sum('montant');
    }
    
    public static function depensesRegleesSurPlace($dateDebut, $dateFin, $userId){
        return Depense::where('system_client_id', $userId)
            ->whereDate('created_at', '>=', $dateDebut)
            ->whereDate('created_at', '<=', $dateFin)
            ->get()
            ->sum('montant_regle_sur_place');
    }

    public static function portionJournaliereChagesIndirectes(){
        return CalculationsClass::portionJournaliereSalaires() + CalculationsClass::portionJournaliereDetteFournisseur() + CalculationsClass::portionJournaliereDetteFinanciere() + CalculationsClass::portionJournaliereAutreChages();
    }
    

    public static function chagesIndirectes($cle){
        $id = MainClass::getSystemId();
        $dette_fournisseur = detteFournisseur::where('status', $cle)
        ->whereHas('approvisionnementSystemProduit.produitsBrut', function($query) use($id){
            $query->where('system_client_id', $id);
        })
        ->get(['montant', 'montant_paye'])
        ->sum(function($dette){
            return $dette->montant - $dette->montant_paye;
        });

        $dette_financiere = DetteFinanciere::where('status', $cle)
        ->where('system_client_id', $id)
        ->get(['montant_emprunte', 'montant_interet', 'montant_paye'])
        ->sum(function($dette){
            return ($dette->montant_emprunte + $dette->montant_interet) - $dette->montant_paye;
        });

        $total_salaires = Personnel::where('system_client_id', $id)
        ->with('contrat')->get('id')
        ->sum('salaire_mensuel');

        $autres_charges = Charges::where('system_client_id', $id)
        ->get('montant')
        ->sum('montant');

        return round($dette_fournisseur + $dette_financiere + $total_salaires + $autres_charges, CalculationsClass::$precision);
    }


    public static function portionJournaliere($montant, $effectiveDate = null, $deadline = null) {
        $joursTravailles = ($effectiveDate && $deadline) ?
         CalculationsClass::calculateWorkingDaysBetweenDates($effectiveDate, $deadline) :
         MainClass::getNumberOfWorkingDaysInThisMonth();

        return round($joursTravailles > 0 ? $montant / $joursTravailles : $montant, CalculationsClass::$precision);
    }

    public static function calculateWorkingDaysBetweenDates($effectiveDate, $deadline){
        $jours_de_repos = System_client::findOrFail(MainClass::getSystemId())->jours_de_repos->toArray();
        $nonWorkingDays = MainClass::translateDaysToEnglish(array_unique(array_column($jours_de_repos, 'libelle')));
        $joursTravailles = 0;
        $effectiveDate = Carbon::parse($effectiveDate);
        $deadline = Carbon::parse($deadline);
        $compt = 0;
        for ($date = $effectiveDate; $date->lte($deadline); $date->addDay()) {
            $compt++;
            if($compt > 7305){return 1;}
            $jourSemaine = strtolower($date->format('l'));
            if (!in_array($jourSemaine, $nonWorkingDays)) {
                $joursTravailles++;
            }
        }
        return $joursTravailles;
    }

    public static function calculerTailleDepassement($dateDebut, $dateFin, $periodicite) {
        
        $startDate = Carbon::parse($dateDebut);
        $endDate = Carbon::parse($dateFin);

        $diffInDays = $startDate->diffInDays($endDate, false);
        if($diffInDays <= 0){
            return 0; 
        }

        // Selon la périodicité, calculons le depassement
        switch (strtolower($periodicite)) {
            case 'jour':
                return ceil($diffInDays); // Nombre total de jours

            case 'semaine':
                return ceil(num: $diffInDays / 7); // Nombre de semaines, y compris les parties fractionnaires

            case 'mois':
                return ceil($diffInDays / 30.44); // Nombre de mois approximatif (moyenne d'un mois)

            case 'trimestre':
                return ceil($diffInDays / (30.44 * 3)); // Nombre de trimestres (3 mois)

            case 'semestre':
                return ceil($diffInDays / (30.44 * 6)); // Nombre de semestres (6 mois)

            case 'an':
                return ceil($diffInDays / 365.25); // Nombre d'années (moyenne incluant les années bissextiles)

            default:
                throw new \Exception("Périodicité non prise en charge : $periodicite");
        }
    }

    
}