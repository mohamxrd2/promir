<?php
namespace App\Http\Controllers;
use App\Classes\Bilan;
use App\Classes\CalculationsClass;
use App\Classes\CoteCalculationClass;
use App\Classes\MainClass;
use App\Models\Approvisionnement;
use App\Models\AvanceClient;
use App\Models\DetteFinanciere;
use App\Models\detteFournisseur;
use App\Models\DettesClients;
use App\Models\Payement;
use App\Models\PrestationService;
use App\Models\Production;
use App\Models\RevenuExceptionnel;
use App\Models\Ventes;
use App\Services\ActirPassifService;
use Carbon\Carbon;
use Illuminate\Http\Request;
class EtatsController extends Controller
{
    public function resultatIndex () {
        $today = Carbon::today();
        return view("etats.compte_de_resultat", compact(["today"]));
    }
   
    public function bilanIndex() {
        $today = Carbon::today();
        return view("etats.compte_de_bilan", compact(["today"]));
    }

    public function resultatExercice($date){
        $endDate = Carbon::parse($date);
        $startOfYear = $endDate->startOfYear()->format('Y-m-d'); 
        $ca = CalculationsClass::chiffreAffaire($startOfYear, $endDate);
        $charges_d_interets = $this->depensesSurChargesDInterets($startOfYear, $endDate);
        $autres_recettes = $this->autresRecetteSurActivites($startOfYear, $endDate);
        $depenses_sur_loyer = $this->depensesSurLoyer($startOfYear, $endDate);
        $depenses_sur_salaires = $this->depensesSurSalaires($startOfYear, $endDate);
        $depenses_sur_achats = $this->depensesSurAchats($startOfYear, $endDate);
        $autres_depenses_sur_activites = $this->autresDepensesSurActivites($startOfYear, $endDate);
        $depenses_sur_impots_et_taxes = $this->depensesSurImpotsEtTaxes($startOfYear, $endDate);
        $variation_stock = $this->variationsDesStocks($startOfYear, $endDate);
        $variationCreance = $this->variationCreance($startOfYear, $endDate);
        $variationDettes = $this->variationDettes($startOfYear, $endDate);
        $dotataion_aux_amortissements = $this->dotataionAuxAmortissements($startOfYear, $endDate);

        $total_recettes = $ca + $autres_recettes;
        $total_depenses = $depenses_sur_achats + $depenses_sur_loyer + $depenses_sur_salaires + $depenses_sur_impots_et_taxes + $charges_d_interets + $autres_depenses_sur_activites;
        
        $solde = $total_recettes - $total_depenses;


        $total_recettes = $ca + $autres_recettes;

        return $solde + $variation_stock + $variationCreance - $variationDettes - $dotataion_aux_amortissements;
    }


    public function renderCompteResultatElementsBetweenDates(Request $request){
        $ca = CalculationsClass::chiffreAffaire($request->startDate, $request->endDate);
        $charges_d_interets = $this->depensesSurChargesDInterets($request->startDate, $request->endDate);
        $autres_recettes = $this->autresRecetteSurActivites($request->startDate, $request->endDate);
        $depenses_sur_loyer = $this->depensesSurLoyer($request->startDate, $request->endDate);
        $depenses_sur_salaires = $this->depensesSurSalaires($request->startDate, $request->endDate);
        $depenses_sur_achats = $this->depensesSurAchats($request->startDate, $request->endDate);
        $autres_depenses_sur_activites = $this->autresDepensesSurActivites($request->startDate, $request->endDate);
        $depenses_sur_impots_et_taxes = $this->depensesSurImpotsEtTaxes($request->startDate, $request->endDate);
        $variation_stock = $this->variationsDesStocks($request->startDate, $request->endDate);
        $variationCreance = $this->variationCreance($request->startDate, $request->endDate);
        $variationDettes = $this->variationDettes($request->startDate, $request->endDate);
        $dotataion_aux_amortissements = $this->dotataionAuxAmortissements($request->startDate, $request->endDate);
        
        $total_recettes = $ca + $autres_recettes;
        $total_depenses = $depenses_sur_achats + $depenses_sur_loyer + $depenses_sur_salaires + $depenses_sur_impots_et_taxes + $charges_d_interets + $autres_depenses_sur_activites;

        $solde = $total_recettes - $total_depenses;

        $total_recettes = $ca + $autres_recettes;

        $resultat_exercice = $solde + $variation_stock + $variationCreance - $variationDettes - $dotataion_aux_amortissements;
        
        return response()->json([
            'ca' =>$this->formatNumber($ca),
            'charges_d_interets' =>$this->formatNumber($charges_d_interets),
            'autres_recettes' =>$this->formatNumber($autres_recettes),
            'depenses_sur_loyer' =>$this->formatNumber($depenses_sur_loyer),
            'depenses_sur_salaires' =>$this->formatNumber($depenses_sur_salaires),
            'depenses_sur_achats' =>$this->formatNumber($depenses_sur_achats),
            'autres_depenses_sur_activites' =>$this->formatNumber($autres_depenses_sur_activites),
            'depenses_sur_impots_et_taxes' =>$this->formatNumber($depenses_sur_impots_et_taxes),
            'variation_stock' =>$this->formatNumber($variation_stock),
            'variationCreance' =>$this->formatNumber($variationCreance),
            'variationDettes' =>$this->formatNumber($variationDettes),
            'total_recettes' =>$this->formatNumber($total_recettes),
            'total_depenses' =>$this->formatNumber($total_depenses),
            'solde' =>$this->formatNumber($solde),
            'dotataion_aux_amortissements' =>$this->formatNumber($dotataion_aux_amortissements),
            'resultat_exercice' =>$this->formatNumber($resultat_exercice),
        ]);
    }
    
    

    public function renderCompteBilanElementsOnDate(Request $request, ActirPassifService $actifPassifService){
        $resultatExercice = $this->resultatExercice($request->date);
        $actif = $actifPassifService->actifFunction($request->date);
        $passif = $actifPassifService->passifFunction($request->date, $resultatExercice);

        return response()->json([
            
            //Les données de l'actif
            'fraisEtablissement' =>$actif['fraisEtablissement'],
            'fraisDeRechercheDeDeveloppement' =>$actif['fraisDeRechercheDeDeveloppement'],
            'brevetsLicense' =>$actif['brevetsLicense'],
            'avancesEtAcompte' =>$actif['avancesEtAcompte'],
            'autresImmobilisationsIncorporelles' =>$actif['autresImmobilisationsIncorporelles'],
            'terrain' =>$actif['terrain'],
            'constructions' =>$actif['constructions'],
            'installationsTechniques' =>$actif['installationsTechniques'],
            'materielDeBureau' =>$actif['materielDeBureau'],
            'autresImmobilisationsCorporelle' =>$actif['autresImmobilisationsCorporelle'],
            'matierePremiere' =>$actif['matierePremiere'],
            'produitsFinis' =>$actif['produitsFinis'],
            'creanceClients' =>$actif['creanceClients'],
            'disponiblites' =>$actif['disponiblites'],
            'totalActif' => $actif['totalActif'],

            //Les donnes du passif
            'capital' =>$passif['capital'],
            'resultatExercice' =>$passif['resultatExercice'],
            'dettesBancaires' =>$passif['dettesBancaires'],
            'autresDettesFinancieres' =>$passif['autresDettesFinancieres'],
            'dettesFournisseurs' =>$passif['dettesFournisseurs'],
            'dettesSocialesEtFiscales' =>$passif['dettesSocialesEtFiscales'],
            'dettesSurImmobilisations' =>$passif['dettesSurImmobilisations'],
            'totalPassif' => $passif['totalPassif'],
        ]);
    }



    private function formatNumber($number) {
        return number_format($number, 0, '', ' ');
    }


    private function recettesPrestations($startDate, $endDate){
        return PrestationService::whereHas('service', function ($query) {
                $query->where('system_client_id', MainClass::getSystemId());
            })
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->whereHas('payement')
            ->with('payement')
            ->get()
            ->sum('montant_regle');
    }
    

    private function recettesVentes($startDate, $endDate){
        return  Ventes::whereHas('lignClientSystem.systemClient', function ($query)  {
            $query->where('id', MainClass::getSystemId());
        })
        ->with('lignesVente')
        ->whereDate('created_at', '>=', $startDate)
        ->whereDate('created_at', '<=', $endDate)
        ->get()
        ->sum('montant_regle');
    }
    
    private function recettesDettesClients($startDate, $endDate){
        return  Payement::whereHas('detteClient')
        ->whereDate('created_at', '>=', $startDate)
        ->whereDate('created_at', '<=', $endDate)
        ->sum('montant');
    } 
    
    private function autresRecetteSurActivites($startDate, $endDate){
        return  RevenuExceptionnel::where('system_client_id', MainClass::getSystemId())
        ->whereDate('created_at', '>=', $startDate)
        ->whereDate('created_at', '<=', $endDate)
        ->sum('montant');
    }
    

    
    
    private function depensesSurSalaires($startDate, $endDate){
        return CalculationsClass::portionJournaliereSalaires() * 
        CalculationsClass::calculateWorkingDaysBetweenDates($startDate, $endDate);
    } 
    

    private function depensesSurLoyer($startDate, $endDate){
        return CalculationsClass::portionJournaliereChargeSurLoyer() * 
        CalculationsClass::calculateWorkingDaysBetweenDates($startDate, $endDate);
    } 
    
    private function depensesSurImpotsEtTaxes($startDate, $endDate){
        return CalculationsClass::portionJournaliereChargeSurImpot() * 
        CalculationsClass::calculateWorkingDaysBetweenDates($startDate, $endDate);
    } 
    
    private function autresDepensesSurActivites($startDate, $endDate){
        return CalculationsClass::portionJournaliereAutreChages() * 
        CalculationsClass::calculateWorkingDaysBetweenDates($startDate, $endDate);
    } 
    
    private function depensesSurChargesDInterets($startDate, $endDate){
        return detteFournisseur::whereHas('approvisionnementSystemProduit.produitsBrut', function($query){
            $query->where('system_client_id', MainClass::getSystemId());
        })
        ->whereDate('date_echeance', '>=' , $startDate)
        ->whereDate('date_effet', '>=' , $endDate)
        ->get()
        ->sum('interet_penalite')
        +
        DetteFinanciere::where('system_client_id', MainClass::getSystemId())
        ->whereDate('date_echeance', '>=' , $startDate)
        ->whereDate('date_effet', '>=' , $endDate)
        ->get()
        ->sum('interet_penalite');
    }

    private function depensesSurAchats($startDate, $endDate){
        return round(Approvisionnement::with('produitsBruts')->whereDate('created_at', '>=', $startDate)
                                ->whereDate('created_at', '<=', $endDate)
                                ->get('id')
                                ->sum('montant'), 4);
    }
    
    private function dotataionAuxAmortissements($startDate, $endDate){
        return 0;
    }
    

    private function variationsDesStocks($startDate, $endDate){
        return Approvisionnement::with(relations: 'produitsBruts')
                                ->whereDate('created_at', '>=', $startDate)
                                ->whereDate('created_at', '<=', $endDate)
                                ->get('id')
                                ->sum('montant') 
                                +
                                Production::whereDate('created_at', '>=', $startDate)
                                ->whereDate('created_at', '<=', $endDate)
                                ->with('produitTransforme')
                                ->get('id')
                                ->sum('montant')
                                -
                                Ventes::whereHas('lignClientSystem.systemClient', function ($query)  {
                                    $query->where('id', MainClass::getSystemId());
                                })
                                ->with('lignesVente')
                                ->whereDate('created_at', '>=', $startDate)
                                ->whereDate('created_at', '<=', $endDate)
                                ->get()
                                ->sum('montant_vente')
                                ;
                                

    }


    private function variationCreance($startDate, $endDate){

        /* 
        Variation des créances = Créances à la fin de N − Créances à la fin de (N−1). 
        Or Créances à la fin de N = Créances à la fin de (N−1) + Créances ajoutées au cours de la période − Créances réglées au cours de la période.
        En combinant les deux formules, on retient la formule simplifiée suivante:
            Variation des créances = Créances ajoutées au cours de la période - Créances réglées au cours de la période.

        */


        // Calcul des créances ajoutées au cours de la période
        $creancesAjoutees = DettesClients::whereHas('ligneVente.vente.lignClientSystem', function($query) {
                $query->where('system_client_id', MainClass::getSystemId());
            })
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->sum('montant');

        // Calcul des créances réglées au cours de la période
        $creancesReglees = Payement::whereHas('detteClient')
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->sum('montant');

        // Variation des créances = Créances ajoutées - Créances réglées
        return $creancesAjoutees - $creancesReglees;
    }
    
    private function variationDettes($startDate, $endDate){

        /* 
            En appliquant  les memes analyses que dans la fonction variationCreance(...), on obtient la formule simplifiée suivante pour le calcule de la variation des dettes.
            Variation des dettes d'exploitation = Dettes ajoutées au cours de la période - Dettes réglées au cours de la période.
        */


        // Calcul des dettes ajoutées au cours de la période
        $dettesAjoutees = detteFournisseur::whereHas('approvisionnementSystemProduit.produitsBrut', function($query){
                $query->where('system_client_id', MainClass::getSystemId());
            })
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->sum('montant')
            + 
            AvanceClient::whereHas('ligneVente.vente.lignClientSystem', function($query){
                $query->where('system_client_id', MainClass::getSystemId());
            })->with('ligneVente')
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->get()
            ->sum('montant');
            


        // Calcul des dettes réglées au cours de la période
        $dettesReglees = Payement::whereHas('detteFournisseur')
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->sum('montant')
            +
            Payement::whereHas('avanceClient')
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->sum('montant');

        // Variation des dettes = dettes ajoutées - dettes réglées
        return $dettesAjoutees - $dettesReglees;
    }

}
