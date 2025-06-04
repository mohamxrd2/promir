<?php 
namespace App\Classes;
use Exception;
use Carbon\Carbon;
use App\Models\Caisses;
use App\Classes\MainClass;
use App\Models\AvanceClient;
use App\Models\DettesClients;
use App\Models\System_produit;
use App\Models\DetteFinanciere;
use App\Models\Investissements;
use App\Models\detteFournisseur;
use App\Models\ProduitTransforme;
use Illuminate\Support\Facades\Auth;
class Bilan{
    public function __construct(){

    }

    public static function fraisEtablissement($date){
        try{
            $investissements = Investissements::where("system_client_id", MainClass::getSystemId())
            ->whereDate('date_acquisition', '<=', $date)
            ->whereDate('date_peremption', '>=', $date)
            ->where('libelle', "Frais d'établissement")->get();
            $brut = $investissements->sum('montant');
            $amorti = $investissements->sum(function ($inv) use ($date) {
                    $totalDays = Bilan::calculateTotalDays($inv->date_acquisition, $inv->duree_de_vie);
                    return ($totalDays > 0 ? ($inv->montant / $totalDays): 0) * (Carbon::parse(time: $inv->date_acquisition)->diffInDays(Carbon::parse($date)));
            });

        }catch(Exception $e){
            $brut = 0;
            $amorti = 0;
        }
        $net = $brut - $amorti;
        return [ round($brut,2), round($amorti, 2), round($net, 2)];
    }

  




    
    public static function materielDeBureau($date){
        try{
            $investissements = Investissements::where("system_client_id", MainClass::getSystemId())
            ->whereDate('date_acquisition', '<=', $date)
            ->whereDate('date_peremption', '>=', $date)
            ->where('libelle', "Matériel de bureau")->get();
            $brut = $investissements->sum('montant');
            $amorti = $investissements->sum(function ($inv) use ($date) {
                    $totalDays = Bilan::calculateTotalDays($inv->date_acquisition, $inv->duree_de_vie);
                    return ($totalDays > 0 ? ($inv->montant / $totalDays): 0) * (Carbon::parse(time: $inv->date_acquisition)->diffInDays(Carbon::parse($date)));
                }
            );
        
        }catch(Exception $e){
            $brut = 0;
            $amorti = 0;
        }
        $net = $brut - $amorti;
        return [ round($brut,2), round($amorti, 2), round($net, 2)];
    }
    
    
    public static function fraisDeRechercheDeDeveloppement($date){
        try{
            $investissements = Investissements::where("system_client_id", MainClass::getSystemId())
            ->whereDate('date_acquisition', '<=', $date)
            ->whereDate('date_peremption', '>=', $date)
            ->where('libelle', "Frais de recherche")->get();
            $brut = $investissements->sum('montant');
            $amorti = $investissements->sum(function ($inv) use ($date) {
                    $totalDays = Bilan::calculateTotalDays($inv->date_acquisition, $inv->duree_de_vie);
                    return ($totalDays > 0 ? ($inv->montant / $totalDays): 0) * (Carbon::parse(time: $inv->date_acquisition)->diffInDays(Carbon::parse($date)));
                }
            );
        }catch(Exception $e){
            $brut = 0;
            $amorti = 0;
        }
        $net = $brut - $amorti;
        return [ round($brut,2), round($amorti, 2), round($net, 2)];
    }
    

    public static function terrain($date){
        try{
            $investissements = Investissements::where("system_client_id", MainClass::getSystemId())
            ->whereDate('date_acquisition', '<=', $date)
            ->whereDate('date_peremption', '>=', $date)
            ->where('libelle', "Terrain")->get();
            $brut = $investissements->sum('montant');
            $amorti = $investissements->sum(function ($inv) use ($date) {
                    $totalDays = Bilan::calculateTotalDays($inv->date_acquisition, $inv->duree_de_vie);
                    return ($totalDays > 0 ? ($inv->montant / $totalDays): 0) * (Carbon::parse(time: $inv->date_acquisition)->diffInDays(Carbon::parse($date)));
                }
            );
        }catch(Exception $e){
            $brut = 0;
            $amorti = 0;
        }
        $net = $brut - $amorti;
        return [ round($brut,2), round($amorti, 2), round($net, 2)];
    }
    

    public static function installationsTechniques($date){
        try{
            $investissements = Investissements::where("system_client_id", MainClass::getSystemId())
            ->whereDate('date_acquisition', '<=', $date)
            ->whereDate('date_peremption', '>=', $date)
            ->where('libelle', "Installations techniques")->get();
            $brut = $investissements->sum('montant');
            $amorti = $investissements->sum(function ($inv) use ($date) {
                    $totalDays = Bilan::calculateTotalDays($inv->date_acquisition, $inv->duree_de_vie);
                    return ($totalDays > 0 ? ($inv->montant / $totalDays): 0) * (Carbon::parse(time: $inv->date_acquisition)->diffInDays(Carbon::parse($date)));
                }
            );
        }
        catch(Exception $e){
            $brut = 0;
            $amorti = 0;
        }
        $net = $brut - $amorti;
        return [ round($brut,2), round($amorti, 2), round($net, 2)];
    }
    
    

    public static function avancesEtAcompte($date){
        try{
            $brut = AvanceClient::whereHas('ligneVente.vente.lignClientSystem', function($query){
                $query->where('system_client_id', MainClass::getSystemId());
            })
            ->whereDate('created_at', '<=', $date)
            ->where('estFinalisee', false)
            ->with('ligneVente')
            ->get()
            ->sum('montant');

            $amorti = 0;
        }catch(Exception $e){
            $brut = 0;
            $amorti = 0;
        }
        $net = $brut;
        return [ round($brut,2), round($amorti, 2), round($net, 2)];
    } 
    
    
    
    public static function dettesBancaires($date){
        try{
            $brut = DetteFinanciere::where('system_client_id', MainClass::getSystemId())
            ->whereDate('date_effet', '<=', $date)
            ->where('type_creancier', 'Banque')
            ->get()
            ->sum(function($dette){
                return $dette->montant_emprunte - $dette->montant_paye;
            });
            
            $amorti = 0;
        }catch(Exception $e){
            $brut = 0;
            $amorti = 0;
        }
        $net = $brut;
        return [ round($brut,2), round($amorti, 2), round($net, 2)];
    }
    
    
    public static function autresDettesFinancieres($date){
        try{
            $brut = DetteFinanciere::where('system_client_id', MainClass::getSystemId())
            ->whereDate('date_effet', '<=', $date)
            ->where('type_creancier', 'Autre')
            ->get()
            ->sum(function($dette){
                return $dette->montant_emprunte - $dette->montant_paye;
            });
            
            $amorti = 0;
        }catch(Exception $e){
            $brut = 0;
            $amorti = 0;
        }   
        $net = $brut;
        return [ round($brut,2), round($amorti, 2), round($net, 2)];
    }
    
    


    public static function dettesFournisseurs($date){
        try{
            $brut = detteFournisseur::whereHas('approvisionnementSystemProduit.produitsBrut', function($query){
                $query->where('system_client_id', MainClass::getSystemId());
            })
            ->where('date_effet', '<=' , $date)
            ->get()
            ->sum(function($dette){
                return $dette->montant - $dette->montant_paye;
            });
            $amorti = 0;
        }catch(Exception $e){
            $brut = 0;
            $amorti = 0;
        }
        $net = $brut;
        return [ round($brut,2), round($amorti, 2), round($net, 2)];
    }
    
    public static function dettesSurImmobilisations($date){
        try{
            $brut = Investissements::where('system_client_id', MainClass::getSystemId())
            ->whereDate('date_acquisition', '<=' , $date)
            ->where('status', '=' , 'En cours')
            ->get()
            ->sum(function($i){
                return $i->montant - $i->montant_paye;
            });
            $amorti = 0;
        }catch(Exception $e){
            $brut = 0;
            $amorti = 0;
        }
        $net = $brut;
        return [ round($brut,2), round($amorti, 2), round($net, 2)];
    }
     
    public static function autresDettes($date){
        try{
            $brut = Investissements::where('system_client_id', MainClass::getSystemId())
            ->whereDate('date_acquisition', '<=' , $date)
            ->where('status', '=' , 'En cours')
            ->get()
            ->sum(function($i){
                return $i->montant - $i->montant_paye;
            });
            $amorti = 0;
        }catch(Exception $e){
            $brut = 0;
            $amorti = 0;
        }
        $net = $brut;
        return [ round($brut,2), round($amorti, 2), round($net, 2)];
    }
    
    
    public static function dettesSocialesEtFiscales($date){
        // fonction a faire apres
        try{
            $brut = 0;
            $amorti = 0;
        }catch(Exception $e){
            $brut = 0;
            $amorti = 0;
        }
        $net = $brut;
        return [ round($brut,2), round($amorti, 2), round($net, 2)];
    }

    

    public static function constructions($date){
        try{
            $investissements = Investissements::where("system_client_id", MainClass::getSystemId())
            ->whereDate('date_acquisition', '<=', $date)
            ->whereDate('date_peremption', '>=', $date)
            ->where(function($query){
                $query->where('libelle', "Bâtiment")
                    ->OrWhere('libelle', "Usine")
                    ->OrWhere('libelle', "Autre Construction");
            })->get();
            $brut = $investissements->sum('montant');
            $amorti = $investissements->sum(function ($inv) use ($date) {
                    $totalDays = Bilan::calculateTotalDays($inv->date_acquisition, $inv->duree_de_vie);
                    return ($totalDays > 0 ? ($inv->montant / $totalDays): 0) * (Carbon::parse(time: $inv->date_acquisition)->diffInDays(Carbon::parse($date)));
                }
            );
        }catch(Exception $e){
            $brut = 0;
            $amorti = 0;
        }
        $net = $brut - $amorti;
        return [round($brut,2), round($amorti, 2), round($net, 2)];
    }
    
    
    public static function autresImmobilisationsCorporelle($date){
        try{
            $investissements = Investissements::where("system_client_id", MainClass::getSystemId())
                ->whereDate('date_acquisition', '<=', $date)
                ->whereDate('date_peremption', '>=', $date)
                ->where('libelle','!=', "Terrain")
                ->where('libelle', '!=', "Bâtiment")
                ->where('libelle', '!=', "Autre Construction")
                ->where('libelle', '!=', "Installations techniques")
                ->where('libelle', '!=', "Matériel de bureau")
                ->where('libelle', '!=', "Immobilisations en cours")
                ->where('libelle', '!=', "Usine")
                ->get();

            $brut = $investissements->sum('montant');
            $amorti = $investissements->sum(function ($inv) use ($date) {
                    $totalDays = Bilan::calculateTotalDays($inv->date_acquisition, $inv->duree_de_vie);
                    return ($totalDays > 0 ? ($inv->montant / $totalDays): 0) * (Carbon::parse(time: $inv->date_acquisition)->diffInDays(Carbon::parse($date)));
                }
            );
        }catch(Exception $e){
            $brut = 0;
            $amorti = 0;
        }
        $net = $brut - $amorti;
        return [round($brut,2), round($amorti, 2), round($net, 2)];
    }
    

    
    public static function brevetsLicense($date){
        try{
            $investissements = Investissements::where("system_client_id", MainClass::getSystemId())
            ->whereDate('date_acquisition', '<=', $date)
            ->whereDate('date_peremption', '>=', $date)
            ->where(function($query){
                $query->where('libelle', "Brevet");
                $query->orWhere('libelle', "Licence");
                $query->orWhere('libelle', "Droit au bail");
            })
            ->get();
            $brut = $investissements->sum('montant');
            $amorti = $investissements->sum(function ($inv) use ($date) {
                    $totalDays = Bilan::calculateTotalDays($inv->date_acquisition, $inv->duree_de_vie);
                    return ($totalDays > 0 ? ($inv->montant / $totalDays): 0) * (Carbon::parse(time: $inv->date_acquisition)->diffInDays(Carbon::parse($date)));
                }
            );
        }catch(Exception $e){
            $brut = 0;
            $amorti = 0;
        }
        $net = $brut - $amorti;
        return [ round($brut,2), round($amorti, 2), round($net, 2)];
    }


    
    public static function matierePremiere($date){
        try {
            $brut = System_produit::where("system_client_id", MainClass::getSystemId())
                ->with([
                    'approvisionnements' => function ($query) use ($date) {
                        $query->whereDate('approvisionnements.created_at', '>', $date);
                    },
                    'approvisionnements.produitsBruts',
                    'lignesVentes' => function ($query) use ($date) {
                        $query->whereDate('ligne_ventes.created_at', '>', $date);
                    }
                ])
                ->get()
                ->sum(function ($produit) {
                    $qte_stck_actuelle = $produit->qte_stck ?? 0;
                    // Quantité à soustraire (approvisionnements après la date)
                    $qte_appro_apres_date = $produit->approvisionnements->sum(function ($appro){
                        return $appro->produitsBruts->sum(function($produit){
                            return $produit->pivot->quantite_entree;
                        });
                    });
                    
                    
                    // Quantité à rajouter (lignesVentes après la date)
                    $qte_sortie_apres_date = $produit->lignesVentes->sum('quantite_vendue');

                    // Stock reconstruit à la date
                    $stock_a_date = $qte_stck_actuelle - $qte_appro_apres_date + $qte_sortie_apres_date;

                    return max(0, $stock_a_date) * $produit->puv;
                });


            $amorti = 0;

        } catch (Exception $e) {

            $brut = $e;
            $amorti = 0;
        }

        $net = $brut - $amorti;

        return [round($brut, 2), round($amorti, 2), round($net, 2)];
    }


    public static function produitsFinis($date) {
        try {
            $clientId = MainClass::getSystemId();

            // 1. Récupérer le stock actuel de tous les produits transformés
            $produits = ProduitTransforme::withSum('productions', 'nbr_portions')
                ->withSum('lignesVente', 'quantite_vendue')
                ->whereHas('productions.produitsBruts', function ($q) use ($clientId) {
                    $q->where('system_client_id', $clientId);
                })
                ->get();

            $brut = $produits->sum(function ($produit) use ($date) {
                $stock_actuel = $produit->qte_en_portions ?? 0;

                // 2. Somme des productions depuis la date
                $produites_recent = $produit->productions()
                    ->whereDate('created_at', '>', $date)
                    ->sum('nbr_portions');

                // 3. Somme des ventes depuis la date
                $vendues_recent = $produit->lignesVente()
                    ->whereDate('created_at', '>', $date)
                    ->sum('quantite_vendue');

                // 4. Somme des livraisons depuis la date
                
                $produits_livres = $produit->livraisons()
                    ->whereDate('created_at', '>', $date)
                    ->sum('quantite_livree');

                // 5. Stock à la date donnée
                $stock_a_la_date = $stock_actuel - $produites_recent + $vendues_recent + $produits_livres;
                // 6. Calcul du brut
                return $stock_a_la_date * $produit->prix_unitaire_portion;
            });

            $amorti = 0;
            $net = $brut - $amorti;

            return [ round($brut, 2), round($amorti, 2), round($net, 2) ];

        } catch (Exception $e) {
            return [0, 0, 0];
        }
    }

    public static function creanceClients($date){
        try{
            $brut = DettesClients::whereHas('ligneVente.vente.lignClientSystem', function($query) {
                $query->where('system_client_id', MainClass::getSystemId());
            })
            ->whereDate('created_at', '<=', $date)
            ->get()
            ->sum(function($dette){
                return $dette->montant - $dette->montant_paye;
            });
        
            $amorti = 0; 
        }catch(Exception $e){
            $brut = 0;
            $amorti = 0;
        }
        $net = $brut - $amorti;
        return [ round($brut,2), round($amorti, 2), round($net, 2)];
    }

    
    
    public static function disponiblites($date){
        try{
            // On prend la première caisse du client
            $caisseClie = Caisses::where('system_client_id', MainClass::getSystemId())
                ->orderBy('id', 'asc')
                ->firstOrFail();

            // On récupère toutes les opérations APRES la date
            $operationsApresDate = $caisseClie->operations()
                ->whereDate('created_at', '>', $date)
                ->get();

            // On calcule le total des opérations après la date
            $mouvementsApresDate = $operationsApresDate->sum(function($op){
                return $op->type_operation == "Retrait" ? -$op->montant : $op->montant;
            });

            // Solde à la date = solde actuel - mouvements après la date
            $brut = $caisseClie->montant - $mouvementsApresDate;
            $amorti = 0;
        }catch(Exception $e){
            $brut = 0;
            $amorti = 0;
        }
        $net = $brut - $amorti;
        return [ round($brut,2), round($amorti, 2), round($net, 2)];
    }
    
    public static function capitalSouscrit($date){
        try{
            $brut = Auth::user()->system_client->capital_social;
            $amorti = 0; 
        }catch(Exception $e){
            $brut = 0;
            $amorti = 0;
        }
        $net = $brut;
        return [round($brut,2), round($amorti, 2), round($net, 2)];
    }



    public static function autresImmobilisationsIncorporelles($date){
            try{
                $investissements = Investissements::where("system_client_id", MainClass::getSystemId())
                ->whereDate('date_acquisition', '<=', $date)
                ->whereDate('date_peremption', '>=', $date)
                ->where('categorie', '=', "Immobilisations incorporels")
                ->where('libelle', '!=', "Brevet")
                ->where('libelle', '!=', "Frais d'établissement")
                ->where('libelle', '!=', "Frais de recherche")
                ->where('libelle', '!=', "Licence")
                ->where('libelle', '!=', "Droit au bail")
                ->where('libelle', '!=', "Fond commercial")
                ->where('libelle', '!=', "Avances et acompte")
                ->get();
                

                $brut = $investissements->sum('montant');
                $amorti = $investissements->sum(function ($inv) use ($date) {
                        $totalDays = Bilan::calculateTotalDays($inv->date_acquisition, $inv->duree_de_vie);
                        return ($totalDays > 0 ? ($inv->montant / $totalDays): 0) * (Carbon::parse(time: $inv->date_acquisition)->diffInDays(Carbon::parse($date)));
                    }
                );
            }catch(Exception $e){
                $brut = 0;
                $amorti = 0;
            }
            $net = $brut - $amorti;
            return [ round($brut,2), round($amorti, 2), round($net, 2)];
    }


    public static function calculateTotalDays(string $date_acquisition, int $duree_de_vie): int {
        $start = Carbon::parse(time: $date_acquisition);
        $end = $start->copy()->addYears($duree_de_vie);
        $totalDays = $start->diffInDays($end);
        return $totalDays > 0 ? $totalDays : 1;
    }
}