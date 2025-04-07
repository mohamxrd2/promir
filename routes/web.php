<?php

use App\Models\Clients;
use App\Models\Produit;
use App\Models\Fournisseurs;
use App\Livewire\Personnel\Add;
use App\Models\CategorieProduit;
use App\Models\LigneClientSysteme;
use App\Livewire\Personnel\Gestion;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EtatsController;
use App\Livewire\Pointage\PointageCompnt;
use App\Http\Controllers\VentesController;
use App\Http\Controllers\CaissesController;
use App\Http\Controllers\ChargesController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LivraisonsController;
use App\Http\Controllers\AvanceClientController;
use App\Http\Controllers\PlansEpargneController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BilanPersonnelController;
use App\Http\Controllers\impayes\ImpayeController;
use App\Http\Controllers\contrat\ContratController;
use App\Http\Controllers\InvestissementsController;
use App\Http\Controllers\ventes\VentesPTController;
use App\Livewire\Ventes\VenteExterieureProduitBrut;
use App\Http\Controllers\ComptesBancairesController;
use App\Http\Controllers\CompteTresorerieController;
use App\Http\Controllers\contrat\FichePaieController;
use App\Http\Controllers\depenses\depensesController;
use App\Http\Controllers\payement\Payementsontroller;
use App\Http\Controllers\PrestationServiceController;
use App\Http\Controllers\services\ServicesController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\profilesManagementController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\dettes\DettesBanquesController;
use App\Http\Controllers\dettes\DettesClientsController;
use App\Http\Controllers\provisions\ProvisionController;
use App\Http\Controllers\RevenusExceptionnelsController;
use App\Http\Controllers\ventes\VentesServicesController;
use App\Http\Controllers\dettes\DetteFinanciereController;
use App\Http\Controllers\produits\SystemPorduitController;
use App\Http\Controllers\fournisseur\FournisseurController;
use App\Http\Controllers\InventaireProduitsFinisController;
use App\Http\Controllers\productions\ProductionsController;
use App\Http\Controllers\dettes\DettesFournisseursController;
use App\Http\Controllers\InventaireMatierePremiereController;
use App\Http\Controllers\recouvrement\recouvrementController;
use App\Http\Controllers\approvisionnements\ApprovisionnementController;

//a revoire

if (!function_exists('set_active')) {
    function set_active($route)
    {
        if (is_array($route)) {
            return in_array(Request::path(), $route) ? 'active' : '';
        }
        return Request::path() == $route ? 'active' : '';
    }
}

// MainClass::updateDateEcheanceCharge();

// dd(Hash::make(123456789));


Route::get('/', function () {
    return view('auth.login');
});




Route::group(['middleware' => 'auth'], function () {
    Route::get('/rechercher-categories', function () {
        $query = request()->query('query');
        $categories = CategorieProduit::where('nom', 'like', "%$query%")->get(['id', 'nom']);
        return response()->json($categories);
    });

    Route::get('/render-produits', [SystemPorduitController::class, 'renderProduits'])->name('render-produits');



    Route::get('/render-elements_vente', [VentesController::class, 'renderElementVente']);
    Route::get('/render-element-a-livrer', [LivraisonsController::class, 'renderElementALivrer']);
    Route::get('/render-elements_vente_pt', [VentesPTController::class, 'renderElementVente']);
    Route::get('/rechercher-clients-pour-vente', [VentesController::class, 'rechercherLignesClientsParInput']);
    Route::get('/rechercher-type-depense', [depensesController::class, 'rechercherTypesParInput']);
    Route::get('/rechercher-lignes_system_produit', [VentesController::class, 'rechercherElementVente']);
    Route::get('/rechercher-lignes_system_produit_pt', [VentesPTController::class, 'rechercherElementVente']);
    Route::get('/rechercher-lignes_fournisseurs', [FournisseurController::class, 'rechercherFournisseursPresents']);
    Route::get('/rechercher-services', [PrestationServiceController::class, 'rechercherServices'])->name('rechercher-services');
    Route::get('/rechercher-produits-a-utiliser', [PrestationServiceController::class, 'rechercherProduits'])->name('rechercher-produits-a-utiliser');
    Route::get('/rechercher-employes-a-utiliser', [PrestationServiceController::class, 'rechercherEmployes'])->name('rechercher-employes-a-utiliser');
    Route::get('/rechercher-banques', [DettesBanquesController::class, 'rechercherBanques'])->name('rechercher-banques');
    Route::get('/rechercher-fiche-paie', [FichePaieController::class, 'rechercherFiche'])->name('rechercher-fiche-paie');

    Route::get('/rechercher-clients', function () {
        $query = request()->query('query');
        $parametre = "%$query%";

        $clientTrouve = Clients::select('clients.*')
            ->leftJoin('ligne_client_systemes', function ($join) {
                $join->on('clients.id', '=', 'ligne_client_systemes.client_id')
                    ->where('ligne_client_systemes.system_client_id', '=', Auth::user()->system_client->id);
            })->whereNull('ligne_client_systemes.client_id')
            ->where(function ($query) use ($parametre) {
                $query->where('nom', 'like', $parametre)
                    ->orWhere('phone', 'like', $parametre)
                    ->orWhere('email', 'like', $parametre);
            })->get();
        return response()->json($clientTrouve);
    });


    Route::get('/rechercher-fournisseurs', function () {
        $query = request()->query('query');
        $query = request()->query('query');
        $parametre = "%$query%";

        $fournisseurTrouve = Fournisseurs::select('fournisseurs.*')
            ->leftJoin('ligne_fournisseurs_systemes', function ($join) {
                $join->on('fournisseurs.id', '=', 'ligne_fournisseurs_systemes.fournisseur_id')
                    ->where('ligne_fournisseurs_systemes.system_client_id', '=', Auth::user()->system_client->id);
            })->whereNull('ligne_fournisseurs_systemes.fournisseur_id')
            ->where(function ($query) use ($parametre) {
                $query->where('nom', 'like', $parametre)
                    ->orWhere('phone', 'like', $parametre)
                    ->orWhere('email', 'like', $parametre);
            })->get();
        return response()->json($fournisseurTrouve);
    });


    Route::get('/rechercher-produits', function () {
        $query = request()->query('query');
        $categorie = request()->query('categorie');
        $produits = Produit::where('designation', 'like', "%$query%")->where('categorie_produit_id', $categorie)->get();
        return response()->json($produits);
    });
    Route::get('/render-produit_properties', function () {
        $query = request()->query('query');
        $produit = Produit::find($query);
        return response()->json($produit);
    });

    Route::get('/render-produit_properties_for_livraison', [LivraisonsController::class, 'renderElementProperties']);
    Route::get('/render-employe_a_utiliser_properties', [PrestationServiceController::class, 'renderEmployeAUtiliserProperties']);
    Route::get('/render-produit_a_utiliser_properties', [PrestationServiceController::class, 'renderProduitAUtiliserProperties']);
    Route::get('/render-produit-inventorie', [InventaireMatierePremiereController::class, 'renderProduitInventorieProperties']);
    Route::get('/render-produit-finis-inventorie', [InventaireProduitsFinisController::class, 'renderProduitInventorieProperties']);

    Route::get('/rechercher-clients_for_livraison', [VentesController::class, 'rechercherLignesClientsParInput']);
    Route::get('/render-client_properties', function () {
        $query = request()->query('query');
        $client = Clients::findOrFail($query);
        return response()->json($client);
    });
    Route::get('/render-client_for_livraison', function () {
        $query = request()->query('query');
        $client = LigneClientSysteme::with('client')->findOrFail($query);
        return response()->json($client);
    });

    Route::get('/render-product_properties_for_vente', [VentesController::class, 'productPropertiesForVente'])->name('render-product_properties_for_vente');
    Route::get('/render_clients_avec_type_vente_pb', [ClientsController::class, 'renderClientsHavingDeleveryOrNot'])->name('render_clients_avec_type_vente_pb');
    Route::get('/render_produits_avec_type_vente_pb', [SystemPorduitController::class, 'renderProductsHavingDeleveryOrNot'])->name('render_produits_avec_type_vente_pb');
    Route::get('/render_produits_avec_type_vente_pt', [SystemPorduitController::class, 'renderProductsHavingDeleveryOrNot'])->name('render_produits_avec_type_vente_pt');
    Route::get('/render_clients_avec_type_vente_pt', [ClientsController::class, 'renderClientsHavingDeleveryOrNot'])->name('render_clients_avec_type_vente_pt');
    Route::get('/render-product_properties_for_vente_pt', [VentesPTController::class, 'productPropertiesForVente'])->name('render-product_properties_for_vente_pt');
    Route::get('/render-fournisseur_properties', [FournisseurController::class, 'fournisseurProperties'])->name('render-fournisseur_properties');
    Route::get('/render-lignefournisseur_properties', [FournisseurController::class, 'ligneFournisseurProperties'])->name('render-lignefournisseur_properties');
    Route::get('/render-service_properties', [PrestationServiceController::class, 'renderServiceProperties'])->name('render-service_properties');

    Route::get('/gestion personnel', Gestion::class)->name('gestion_personnel');
    Route::get('/gestion_vente_vente_exterieure_produit_brute', VenteExterieureProduitBrut::class)->name('venteExternPrduitsBrute');
    Route::get('/pointages', PointageCompnt::class)->name('pointages');

    Route::get('/add personnel', Add::class)->name('add_personnel');
    Route::get('/contrat du personnel', [ContratController::class, 'index'])->name('contrat_personnel');
    Route::get('/gestion des provisions', [ProvisionController::class, 'index'])->name('gestion_provisions');
    Route::get('/fiches de paie des salariers', [FichePaieController::class, 'index'])->name('fiche_paie');
    Route::get('/produits', [SystemPorduitController::class, 'index'])->name('produits');
    Route::get('/inventaire matiere première', [InventaireMatierePremiereController::class, 'index'])->name('inventaire_matiere_premiere');
    Route::get('/inventaire produits finis', [InventaireProduitsFinisController::class, 'index'])->name('inventaire_produits_finis');
    Route::get('/depenses', [depensesController::class, 'index'])->name('depenses');
    Route::get('/services', [ServicesController::class, 'index'])->name('services');
    Route::get('/fournisseurs', [FournisseurController::class, 'index'])->name('fournisseurs');
    Route::get('/revenus exceptionnels', [RevenusExceptionnelsController::class, 'index'])->name('revenu_exceptionnel');
    Route::get('/investissements', [InvestissementsController::class, 'index'])->name('investissements');
    Route::get('/plans_epargne', [PlansEpargneController::class, 'index'])->name('plans_epargne');
    Route::get('/charges', [ChargesController::class, 'index'])->name('charges');
    Route::get('/comptes_bancaires', [ComptesBancairesController::class, 'index'])->name('comptes_bancaires');
    Route::get('/caisses', [CaissesController::class, 'index'])->name('caisses');
    Route::get('/bilan personnel associe', [BilanPersonnelController::class, 'index'])->name('bilan_personnel');
    Route::get('/clients', [ClientsController::class, 'index'])->name('clients');
    Route::get('/vente de produits bruts', [VentesController::class, 'index'])->name('venteProduitsBrut');
    Route::get('/vente de produits transformés', [VentesPTController::class, 'index'])->name('venteProduitsTransforme');
    Route::get('/vente de services', [VentesServicesController::class, 'index'])->name('venteServices');
    Route::get('/prestations de services', [PrestationServiceController::class, 'index'])->name('prestationsServices');
    Route::get('/livraisons', [LivraisonsController::class, 'index'])->name('livraisons');
    Route::get('/productions', [ProductionsController::class, 'index'])->name('productions');
    Route::get('/approvisionnement', [ApprovisionnementController::class, 'index'])->name('approvisionnement');
    Route::get('/dettesClients', [DettesClientsController::class, 'index'])->name('dettesClients');
    Route::get('/dettesFournisseurs', [DettesFournisseursController::class, 'index'])->name('dettesFournisseurs');
    Route::get('/dettesFinanciere', [DetteFinanciereController::class, 'index'])->name('dettesFinanciere');
    Route::get('/impayePT', [ImpayeController::class, 'impayePT'])->name('impayePT');
    Route::get('/impayeService', [ImpayeController::class, 'impayeService'])->name('impayeService');
    Route::get('/approvisionnement', [ApprovisionnementController::class, 'index'])->name('approvisionnement');
    Route::get('/avances des clients', [AvanceClientController::class, 'index'])->name('indexAvanceClients');
    Route::get('/compte de resultat index', [EtatsController::class, 'resultatIndex'])->name('compte_de_resultat');
    Route::get('/compte de tresorerie index', [CompteTresorerieController::class, 'tresorerieIndex'])->name('compte_de_tresorerie');
    Route::get('/compte de bilan index', [EtatsController::class, 'bilanIndex'])->name('compte_de_bilan');
    Route::get('/compte_resultat_in_range', [EtatsController::class, 'renderCompteResultatElementsBetweenDates'])->name('compte_resultat_elements');
    Route::get('/compte_bilan_on_date', [EtatsController::class, 'renderCompteBilanElementsOnDate'])->name('compte_bilan_on_date');

    Route::get('/modify_user_profile', [profilesManagementController::class, 'returnModifyPage'])->name('modify_user_profile');

    Route::get('/generate_reference', [SystemPorduitController::class, 'callFunctionReference'])->name('generate_reference');
    Route::get('/generate_reference_service', [ServicesController::class, 'callFunctionReference'])->name('generate_reference_service');

    Route::get('/display_personnel_for_contrat/{id}', [ContratController::class, 'display_personnel_for_contrat']);
    Route::get('/delete/{id}', [ContratController::class, 'delete'])->name('contrat.delete');
    Route::get('/composition/{id}', [BilanPersonnelController::class, 'delete'])->name('composition.delete');
    Route::get('/delete_produit/{id}', [SystemPorduitController::class, 'delete'])->name('system_produit.delete');
    Route::get('/delete_service/{id}', [ServicesController::class, 'delete'])->name('service.delete');
    Route::get('/delete_caisse/{id}', [CaissesController::class, 'delete'])->name('caisse.delete');
    Route::get('/delete_plan_epargne/{id}', [PlansEpargneController::class, 'delete'])->name('epargne.delete');
    Route::get('/delete_charge/{id}', [ChargesController::class, 'delete'])->name('charge.delete');
    Route::get('/delete_revenus/{id}', [RevenusExceptionnelsController::class, 'delete'])->name('revenus.delete');
    Route::get('/delete_investissement/{id}', [InvestissementsController::class, 'delete'])->name('investissement.delete');
    Route::get('/delete_client/{id}', [ClientsController::class, 'delete'])->name('client.delete');
    Route::get('/delete_compte/{id}', [ComptesBancairesController::class, 'delete'])->name('compte.delete');
    Route::get('/delete_fournisseur/{id}', [FournisseurController::class, 'delete'])->name('fournisseur.delete');
    Route::get('/delete_vente/{id}', [VentesController::class, 'delete'])->name('vente.delete');
    Route::get('/delete_prestation/{id}', [PrestationServiceController::class, 'delete'])->name('prestation.delete');
    Route::get('/delete_livraison/{id}', [LivraisonsController::class, 'delete'])->name('livraison.delete');
    Route::get('/annuler_livraison/{id}', [LivraisonsController::class, 'annuler'])->name('livraison.annuler');
    Route::get('/delete_depense/{id}', [depensesController::class, 'delete'])->name('depense.delete');
    Route::get('/delete_production/{id}', [ProductionsController::class, 'delete'])->name('production.delete');
    Route::get('/delete_approvisionnement/{id}', [ApprovisionnementController::class, 'delete'])->name('approvisionnement.delete');
    Route::get('/delete_dette/{id}', [DettesClientsController::class, 'delete'])->name('dette.delete');
    Route::get('/delete_inventaire/{id}', [InventaireMatierePremiereController::class, 'delete'])->name('inventaire.delete');
    Route::get('/detach produit from production/{idProduit}/{idProduction}', [ProductionsController::class, 'detach'])->name('produit.detach');
    Route::get('/detach produit from approvisionnement/{idProduit}/{idProduction}', [ApprovisionnementController::class, 'detach'])->name('produitOpfApprovisionnement.detach');

    Route::post('/finalisation_avance', [AvanceClientController::class, 'finaliserAvance'])->name('finaliserAvanceClients');
    Route::post('/user/profile/update', [profilesManagementController::class, 'editeUserProfile'])->name('user.profile.update');
    Route::post('/edit_personnel_contrat', [ContratController::class, 'edite'])->name('contrat.edite');
    Route::post('/edit_service', [ServicesController::class, 'edite'])->name('service.edite');
    Route::post('/edit_plan', [PlansEpargneController::class, 'edite'])->name('plan.edite');
    Route::post('/edit_charge', [ChargesController::class, 'edite'])->name('charge.edite');
    Route::post('/edit_investissement', [InvestissementsController::class, 'edite'])->name('investissement.edite');
    Route::post('/edit_revenu_exceptionnel', [RevenusExceptionnelsController::class, 'edite'])->name('revenu_exceptionnel.edite');
    Route::post('/edit_produit', [SystemPorduitController::class, 'edite'])->name('produit.edite');
    Route::post('/edit_client', [ClientsController::class, 'edite'])->name('client.edite');
    Route::post('/edit_fournisseur', [FournisseurController::class, 'edite'])->name('fournisseur.edite');
    Route::post('/edit_compte', [ComptesBancairesController::class, 'edite'])->name('compte.edite');
    Route::post('/edit_dette_clients', [DettesClientsController::class, 'edite'])->name('dette_clients.edite');
    Route::post('/edit_dette_fournisseur', [DettesFournisseursController::class, 'edite'])->name('dette_fournisseurs.edite');
    Route::post('/edit_dette_banques', [DettesBanquesController::class, 'edite'])->name('dette_banques.edite');
    Route::post('/edit_dette_financiere', [DetteFinanciereController::class, 'edite'])->name('dette_financiere.edite');
    Route::post('/edit_caisse', [CaissesController::class, 'edite'])->name('caisse.edite');
    Route::post('/edit_depense', [depensesController::class, 'edite'])->name('depense.edite');
    Route::post('/edit_vente', [VentesController::class, 'edite'])->name('vente.edite');
    Route::post('/edit_inventaire', [InventaireMatierePremiereController::class, 'edite'])->name('inventaire.edite');
    Route::post('/edit_inventaire_pt', [InventaireProduitsFinisController::class, 'edite'])->name('inventaire_pt.edite');
    Route::post('/edit_vente_pt', [VentesPTController::class, 'edite'])->name('vente_pt.edite');
    Route::post('/edit_vente_service', [VentesServicesController::class, 'edite'])->name('vente_service.edite');
    Route::post('/edit_livraison', [LivraisonsController::class, 'edite'])->name('livraison.edite');
    Route::post('/edit_produit_of_production', [ProductionsController::class, 'editeProdduitOfProduction'])->name('productionProduit.edite');
    Route::post('/add_payement_dette_client', [Payementsontroller::class, 'addPayementDette'])->name('payementDetteClient.edite');
    Route::post('/add_payement_dette_banque', [Payementsontroller::class, 'addPayementDette'])->name('payementDetteBanque.edite');
    Route::post('/add_payement_dette_financiere', [Payementsontroller::class, 'addPayementDette'])->name('payementDetteFinanciere.edite');
    Route::post('/add_payement_dette_fournisseur', [Payementsontroller::class, 'addPayementDette'])->name('payementDetteFournisseur.edite');
    Route::post('/add_payement_dette_sur_avance_produit', [Payementsontroller::class, 'addPayementDette'])->name('payementDetteSurAvanceProduit.edite');
    Route::post('/add_payement_investissement', [Payementsontroller::class, 'addPayementDette'])->name('payementDetteSurInvestissement.edite');
    Route::post('/add_recouvrement', [recouvrementController::class, 'addRecouvrement'])->name('recouvrement.produitfini');
    Route::post('/add_recouvrementPT', [recouvrementController::class, 'addRecouvrementPT'])->name('recouvrement.produittransforme');
    Route::post('/add_recouvrementService', [recouvrementController::class, 'addRecouvrementService'])->name('recouvrement.service');
    Route::post('/edit_produit_of_approvisionnement', [ApprovisionnementController::class, 'editeProdduitOfApprovisionnement'])->name('approvisionnementProduit.edite');

    Route::post('/store_personnel_contrat', [ContratController::class, 'store']);
    Route::post('/store_livraison', [LivraisonsController::class, 'store']);
    Route::post('/store_system_produit', [SystemPorduitController::class, 'store']);
    Route::post('/store_client', [ClientsController::class, 'store']);
    Route::post('/store_service', [ServicesController::class, 'store']);
    Route::post('/store_plan', [PlansEpargneController::class, 'store']);
    Route::post('/store_charge', [ChargesController::class, 'store']);
    Route::post('/store_bilan', [BilanPersonnelController::class, 'store']);
    Route::post('/store_investissement', [InvestissementsController::class, 'store']);
    Route::post('/store_revenu_exceptionnel', [RevenusExceptionnelsController::class, 'store']);
    Route::post('/store_fournisseur', [FournisseurController::class, 'store']);
    Route::post('/store_compte_bancaire', [ComptesBancairesController::class, 'store']);
    Route::post('/store_dette_client', [DettesClientsController::class, 'store']);
    Route::post('/store_plan_dette_fournisseur', [DettesFournisseursController::class, 'storePlanRelement']);
    Route::post('/store_plan_dette_client', [DettesClientsController::class, 'storePlanRelement']);
    Route::post('/store_dette_financiere', [DetteFinanciereController::class, 'store']);
    Route::post('/store_operation', [CaissesController::class, 'storeOperation']);
    // Route::post('/store_caisse',[CaissesController::class, 'store']);
    Route::post('/store_depense', [depensesController::class, 'store']);
    Route::post('/store_vente', [VentesController::class, 'store']);
    Route::post('/store_inventaire', [InventaireMatierePremiereController::class, 'store']);
    Route::post('/store_inventaire_pt', [InventaireProduitsFinisController::class, 'store']);
    Route::post('/store_production', [ProductionsController::class, 'store']);
    Route::post('/store_approvisionnement', [ApprovisionnementController::class, 'store']);
    Route::post('/store_vente_pt', [VentesPTController::class, 'store']);
    Route::post('/store_prestation_service', [PrestationServiceController::class, 'store']);
    Route::post('/store-compte-tresorerie', [CompteTresorerieController::class, 'storeCompteTresorerie']);
    Route::post('/store-store-provision-jour', [ProvisionController::class, 'store']);



    Route::get('/render-details-vente', [VentesController::class, 'renderLignesVenteForDetailsOfVente']);
    Route::get('/render-details-vente_pt', [VentesPTController::class, 'renderLignesVenteForDetailsOfVente'])->name('render-details-vente_pt');
    Route::get('/render-details-production', [ProductionsController::class, 'renderCompositionOfProduction'])->name('render-details-production');
    Route::get('/render-details-approvisionnement', [ApprovisionnementController::class, 'renderProduitsOfApprovisionnement'])->name('ender-details-approvisionnement');
    Route::get('/render-details-vente_services', [VentesServicesController::class, 'renderLignesVenteForDetailsOfVente'])->name('render-details-vente_services');

    Route::get('home', function () {
        return view('dashboard.home');
    });

    Route::get('/api/json/charges', function () {
        $jsonData = Storage::disk('local')->get('jsonStorage/charges.json');
        return response()->json(json_decode($jsonData, true));
    });

    Route::get('/api/json/investissements', function () {
        $jsonData = Storage::disk('local')->get('jsonStorage/investissements.json');
        return response()->json(json_decode($jsonData, true));
    });
});



Auth::routes();

Route::group(['namespace' => 'App\Http\Controllers\Auth'], function () {
    // -----------------------------login----------------------------------------//

    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'authenticate')->name('login');
        Route::get('/logout', 'logout')->name('logout');
        Route::get('logout/page', 'logoutPage')->name('logout/page');
    });

    // ------------------------------ register ----------------------------------//
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'register')->name('register');
        Route::post('/register', 'store')->name('register');
    });

    // ----------------------------- forget password ----------------------------//
    Route::controller(ForgotPasswordController::class)->group(function () {
        Route::get(' forget-password', 'getEmail')->name('forget-password');
        Route::post('forget-password', 'postEmail')->name('forget-password');
    });

    // ----------------------------- reset password -----------------------------//
    Route::controller(ResetPasswordController::class)->group(function () {
        Route::get('reset-password/{token}', 'getPassword');
        Route::post('reset-password', 'updatePassword');
    });
});




Route::group(['namespace' => 'App\Http\Controllers'], function () {
    // -------------------------- main dashboard ----------------------//
    Route::controller(HomeController::class)->group(function () {
        Route::get('/home', 'index')->middleware('auth')->name('home');
    });
});
