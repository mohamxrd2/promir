<?php

namespace App\Http\Controllers;

use App\Classes\MainClass;
use App\Http\Controllers\Controller;
use App\Models\AvanceClient;
use App\Models\Clients;
use App\Models\DettesClients;
use App\Models\ImpayeVente;
use App\Models\LigneClientSysteme;
use App\Models\LigneVente;
use App\Models\Livraisons;
use App\Models\ProduitTransforme;
use App\Models\Services;
use App\Models\System_produit;
use App\Classes\CalculationsClass;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Ventes;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VentesController extends Controller
{
    function generateReference($id, $prefix) {
        do {
            $now = Carbon::now();
            $milliseconds = $now->format('u');
            $formattedDate = $now->format('YmdHis');
            $reference = $prefix. $formattedDate . str_pad($id, 2, '0', STR_PAD_LEFT) . $milliseconds;
        } while(Ventes::where('reference', $reference)->exists());
        return $reference;
    }

    public function index() {
        $today = Carbon::today();
        $systemId = MainClass::getSystemId();
        $ventes = Ventes::whereHas('lignClientSystem.systemClient', function ($query) use ($systemId) {
            $query->where('id', $systemId);
        })
            ->whereDoesntHave('lignesVente.avanceClient')
            ->where('type_vente', 'Produits non transformés')
            ->with(['lignClientSystem', 'lignesVente.systemeProduit.produit.categorie'])->latest()->get();
        // })->whereDate('created_at', Carbon::today())->where('type_vente', 'Produits non transformés')->with(['lignClientSystem', 'lignesVente.systemeProduit.produit.categorie'])->latest()->get();

       
        $cls = Clients::select('clients.*')
            ->leftJoin('ligne_client_systemes as lcs', function($join) use ($systemId) {
                $join->on('clients.id', '=', 'lcs.client_id')
                    ->where('lcs.system_client_id', '=', $systemId);
            })
            ->whereNull('lcs.client_id')
            ->get();

        $clientsPresents = LigneClientSysteme::with('client')->where('system_client_id', $systemId)->orderBy('created_at')->get();
        return view("ventes.vente-produit-brut", compact(["ventes", "clientsPresents", "cls"]));
    }

    public function renderLignesVenteForDetailsOfVente(){
        $id_vente = request()->query('query');
        $vente = Ventes::with(['lignesVente.systemeProduit.produit'])->findOrFail($id_vente);
        // $vente = Ventes::with(['lignesVente.systeme_produit.produit', 'lignesVente.service', 'lignesVente.produit_transf'])->findOrFail($id_vente);
        $lignesVente = $vente->lignesVente;
        return response()->json(['lignesVente' => $lignesVente]);
    }


    public function renderElementVente () {
        try{
            $produits_brut = System_produit::where('system_client_id', MainClass::getSystemId())->with('produit')->orderBy('created_at')->get();
            return response()->json(['produits_brut' => $produits_brut]);
        }catch(\Exception $e){
            return response()->json(['other_error' => true]);
        }
        
    }


    public function productPropertiesForVente(Request $request){
        $id_produit = $request->input('id_produit');
        $produit_brut = System_produit::with('produit')->where('id', $id_produit)->firstOrFail();
        if($request->route()->getName() == "render-product_properties_for_vente"){
            $totalQuantiteLivree = Livraisons::where('ligne_client_systeme_id', $request->input('ligne_client'))
                                        ->where('system_produit_id', $id_produit)
                                        ->where('geree', false)
                                        ->where('annulee', false)
                                        ->sum('quantite_livree');
            return response()->json(['produit_brut' => $produit_brut, 'totalQuantiteLivree'=>$totalQuantiteLivree]);
        }else{
            return response()->json(['produit_brut' => $produit_brut]);
        }
    }


    public function rechercherElementVente(Request $request)
    {
        $terme = "%$request->terme%";
        $typeVente = $request->typeVente;
        try {
            $produits_brut_query = System_produit::whereHas('produit', function ($query) use ($terme) {
                $query->where('reference', 'like', $terme)
                      ->orWhere('designation', 'like', $terme);
            })->where('system_client_id', MainClass::getSystemId())
              ->with('produit')
              ->orderBy('created_at');
    
            if ($typeVente == "Dépôt vente") {
                $client = $request->client;
                $produits_brut_query->whereHas('livraisons', function ($query) use ($client) {
                    $query->whereHas('ligneClientSysteme', function ($query) use ($client) {
                        $query->where('id', $client);
                    });
                });
            }
    
            $produits_brut = $produits_brut_query->get();
    
            return response()->json(['produits_brut' => $produits_brut]);
    
        } catch (\Exception $e) {
            return response()->json(['other_error' => $e->getMessage()], 500);
        }
    }
    

    
public function rechercherLignesClientsParInput(Request $request){
    $terme = $request->terme;
    $terme = "%$terme%";

    if($request->typeVente == "Dépôt vente"){
        $clientTrouve = LigneClientSysteme::whereHas('client', function ($query) use ($terme) {
            $query->where('nom', 'like', $terme)
            ->orWhere('phone', 'like', $terme)
            ->orWhere('email', 'like', $terme);
        })->whereHas('livraisons', function($query){
            $query->whereHas('systemProduit');
        })->where('system_client_id', MainClass::getSystemId())->with('client')->get();
    }else{
        $clientTrouve = LigneClientSysteme::whereHas('client', function ($query) use ($terme) {
            $query->where('nom', 'like', $terme)
            ->orWhere('phone', 'like', $terme)
            ->orWhere('email', 'like', $terme);
        })->where('system_client_id', MainClass::getSystemId())->with('client')->get();
    }
    
    return response()->json($clientTrouve);
}


    public function edite(Request $request){
        $validPayments = ['Payement BIICF', 'Cash', 'Wave', 'Orange money', 'Moov money', 'MTN money', 'Trasor money'];
        // $validesStatusVente = ['En attente', 'Conifimée', 'Annulée'];
        $messages = [
            'reference.required' => 'Une reference est requise.',
            'reference.string' => 'La reference doit être une chaîne de caractères.',
            'reference.max' => 'La reference ne doit pas dépasser :max caractères.',
            'reference.unique' => 'Cette est indisponible.',
            'moyen_payement.string' => 'Le moyen de payement doit être une chaîne de caractères.',
            'moyen_payement.required' => 'Un moyen de payement est requis.',
            'moyen_payement.max' => 'Le moyen de payement ne doit pas dépasser :max caractères.',
            'moyen_payement.in' => 'Le moyen de paiement que vous sélectionnez est invalide.',
           
        ];

        $validator = Validator::make($request->all(), [
            'reference' => 'required|string|max:40|unique:ventes,reference,' .$request->vente_id,
            'moyen_payement' => ['required', 'string','max:40', Rule::in($validPayments)],
            
        ],
        $messages
    );
        
        

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $vente = Ventes::findOrFail($request->vente_id);
        
        $vente->reference = $request->reference;
        $vente->moyen_payement = $request->moyen_payement;

        if($vente->update()){
            return response()->json(["SUCCES!"=>true]);
        }
        return response()->json("Une erreur s'est produite.");
    }

    public function delete($id){
        try {
            $vente = Ventes::findOrFail($id);

            foreach ($vente->lignesVente as $ligneVente) {
                $ligneVente->delete();
            }

            $vente->delete();
            return redirect()->back()->with(toastr()->success('Vente supprimée!', 'OK'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with(toastr()->error('Vente non trouvée!', 'Erreur'));
        }
    }

    public function store(Request $request){
        $message = "Vente ajoutée avec succès.";
        $rules = [
            'produits.*' => 'required|string|max:60',
            'quantite_envoyee.*' => 'nullable|numeric|min:0',
            'quantite_vendue.*' => 'required|numeric|min:0',
            'prix_vente.*' => 'required|numeric|min:0',
            'montant_regle.*' => 'required|numeric|min:0',
            'ligne_client_systeme' => 'min:1',
            'type_de_vente' => ['required', 'string', Rule::in(['Dépôt vente', 'À crédit', 'Au comptant', 'Avance'])],
            'moyen_payement' => ['required', 'string', Rule::in(['Payement BIICF', 'Cash', 'Wave', 'Orange money','Moov money','MTN money','Trasor money'])],
        ];

        $messages = [
            'produits.*.required' => 'Le produit est requis.',
            'ligne_client_systeme.min' => 'Le client choisi presente un problème.',
            'quantite_vendue.*.required' => 'La quantité vendue est requise.',
            'prix_vente.*.required' => 'Le prix de vente est requis.',
            'prix_vente.*.numeric' => 'Le prix de vente doit être un nombre.',
            'quantite_vendue.*.numeric' => 'Un nombre est requis.',
            'quantite_envoyee.*.numeric' => 'Un nombre est requis.',
            'montant_regle.*.numeric' => 'Le montant réglé doit être un nombre.',
            'montant_regle.*.required' => 'Un montant est requis.',
            'moyen_payement.required' => 'Un moyen de payement est requis',
            'type_de_vente.required' => 'Un type est requis.',
            'type_de_vente.in' => 'Le type de vente que vous sélectionnez est invalide.',
            'moyen_payement.in' => 'Le moyen de payement vente que vous sélectionnez est invalide.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        
        if($request->type_de_vente == "Dépôt vente"){

            if(!$request->ligne_client_systeme){
                return response()->json(['clientRequis' =>true]);
            }
        }

        $status_vente = $request->type_de_vente == "Avance" ? 'En attente' : 'Conifimée';
        $newVente = Ventes::create(
            [
              'reference' => $this->generateReference(MainClass::getSystemId(), 'REFVT'),
              'moyen_payement' => $request->moyen_payement,
              'status_vente' => $status_vente,
              'type_vente' => 'Produits non transformés',
              'ligne_client_systeme_id' => $request->ligne_client_systeme,
            ]
        );

        foreach ($request->produits as $index => $produit) {
            $humanIndex = $index+1;
            $produit_brut = System_produit::find($produit);
            if($request->type_de_vente == "Dépôt vente"){
                if($request->quantite_envoyee[$index]<$request->quantite_vendue[$index]){
                    $newVente->lignesVente()->delete();
                    $newVente->delete();
                    return response()->json(['quantiteInsufisante'=> "La quantité livrée du produit $humanIndex est insuffisante!"]);
                };
            }else if($request->type_de_vente == "Au comptant" || $request->type_de_vente == "À crédit"){
                if($produit_brut->qte_stck < $request->quantite_vendue[$index]){
                    $newVente->lignesVente()->delete();
                    $newVente->delete();
                    return response()->json(['quantiteInsufisante'=> "Le stock du produit $humanIndex est insuffisant!" ]);
                };
            }
            
            
            if ($request->type_de_vente == "Dépôt vente") {
                try {
                    $livraison = Livraisons::where('ligne_client_systeme_id', $request->ligne_client_systeme)
                        ->where('system_produit_id', $produit)
                        ->firstOrFail();
                    if($livraison){
                        $livraison->quantite_livree -= $request->quantite_vendue[$index];
                        if($livraison->quantite_livree == 0){
                            $livraison->geree = 1;
                        }
                        $livraison->update();
                    }
                } catch (\Exception $e) {
                    if($newVente->lignesVente()){
                        $newVente->lignesVente()->delete();
                    }
                    $newVente->delete();
                }
            }
            
            $lignevente = LigneVente::create([
                'system_produit_id' => $produit,
                'type_de_produit_a_vendre' => "Produits non transformés",
                'vente_id' => $newVente->id,
                'quantite_envoyee' => $request->quantite_envoyee[$index] ?? NULL,
                'quantite_vendue' => $request->quantite_vendue[$index],
                'prix_vente' => $request->prix_vente[$index],
                'montant_regle' => $request->montant_regle[$index] ?? 0,
            ]);

            if($lignevente){
                if($request->type_de_vente == "Avance"){
                    AvanceClient::create([
                        'ligne_vente_id' => $lignevente->id,
                    ]);
                    $message = "Avance ajoutée avec succès";
                }else{
                    $diff = $request->prix_vente[$index] * $request->quantite_vendue[$index] - $request->montant_regle[$index];
                    if($diff > 0){
                        DettesClients::create([
                            'montant' => $diff,
                            'ligne_vente_id' => $lignevente->id,
                        ]);
                    }

                    if($request->type_de_vente != "Dépôt vente"){
                        $qts = $produit_brut->qte_stck;
                        $produit_brut->qte_stck = $qts - $request->quantite_vendue[$index];
                        $produit_brut->update();
                    }
                }
               
            }
        }

        return response()->json(['message' => $message]);
    }
}
