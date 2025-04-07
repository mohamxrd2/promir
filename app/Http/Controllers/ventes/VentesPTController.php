<?php

namespace App\Http\Controllers\ventes;

use App\Classes\MainClass;
use App\Http\Controllers\Controller;
use App\Models\Clients;
use App\Models\DettesClients;
use App\Models\ImpayeVente;
use App\Models\LigneClientSysteme;
use App\Models\LigneVente;
use App\Models\Livraisons;
use App\Models\ProduitTransforme;
use CalculationsClass;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Ventes;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VentesPTController extends Controller
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
        })->whereDate('created_at', Carbon::today())->where('type_vente', 'Produits transformés')->with(['lignClientSystem', 'lignesVente.produitTransforme'])->latest()->get();

        
        $clientsNonPresents = Clients::select('clients.*')
            ->leftJoin('ligne_client_systemes as lcs', function($join) use ($systemId) {
                $join->on('clients.id', '=', 'lcs.client_id')
                     ->where('lcs.system_client_id', '=', $systemId);
            })
            ->whereNull('lcs.client_id')
            ->get();
            
        $clientsPresents = LigneClientSysteme::with('client')->where('system_client_id', $systemId)->orderBy('created_at')->get();
        return view("ventes.vente-produit-transforme", compact(["ventes", "clientsPresents", "clientsNonPresents"]));
    }

    public function renderLignesVenteForDetailsOfVente(Request $request){
        $idVente = request()->query('query');
        $vente = Ventes::with(['lignesVente.produitTransforme'])->findOrFail($idVente);
        $lignesVentes = $vente->lignesVente;
        return response()->json(['lignesVentes' => $lignesVentes]);
    }


    public function renderElementVente () {
        try{
            $systemId = MainClass::getSystemId();
            $produitsPresents = ProduitTransforme::whereHas('productions.produitsBruts.systemeClient', function ($query) use ($systemId) {
                $query->where('id', $systemId);
            })->get();
            
            return response()->json(['produitsTransformes' => $produitsPresents]);
        }catch(\Exception $e){
            return response()->json(['other_error' => true]);
        }
    }

    public function productPropertiesForVente(Request $request){
        $idProduit = $request->idProduit;
        $ligneClient = $request->ligneClient;
        $produitTransforme = ProduitTransforme::findOrFail($idProduit);
        if($request->route()->getName() == "render-product_properties_for_vente_pt"){
            $totalQuantiteLivree = Livraisons::where('ligne_client_systeme_id', $ligneClient)
            ->where('produit_transforme_id', $idProduit)
            ->where('geree', false)
            ->where('annulee', false)
            ->sum('quantite_livree');            
            return response()->json(['produitTransforme' => $produitTransforme, 'totalQuantiteLivree'=>$totalQuantiteLivree]);
        }else{
            return response()->json(['produitTransforme' => $produitTransforme]);
        }
    }


    public function rechercherElementVente(Request $request) {
        $terme = "%$request->terme%";
        try {
            $produits = ProduitTransforme::whereHas('productions.produitsBruts.systemeClient', function ($query) {
                $query->where('id', MainClass::getSystemId());
            })->where(function ($query) use ($terme) {
                $query->where('reference', 'like', $terme)
                      ->orWhere('designation', 'like', $terme);
            });

            if ($request->typeVente == "Dépôt vente") {
                $client = $request->client;
                $produits->whereHas('livraisons', function ($query) use ($client) {
                    $query->whereHas('ligneClientSysteme', function ($query) use ($client) {
                        $query->where('id', $client);
                    });
                });
            }

            $produitsTransformes = $produits->get();

            return response()->json(['produitsTransformes' => $produitsTransformes]);

        } catch (\Exception $e) {
            return response()->json(['other_error' => $e->getMessage()], 500);
        }
    }



    
    public function rechercherLignesClientsParInput(Request $request){
        $terme = $request->terme;
        $terme = "%$terme%";
        $clientTrouve = [];
        if($request->typeVente == "Dépôt vente"){
            $clientTrouve = LigneClientSysteme::whereHas('client', function ($query) use ($terme) {
                $query->where('nom', 'like', $terme)
                ->orWhere('phone', 'like', $terme)
                ->orWhere('email', 'like', $terme);
            })->whereHas('livraisons', function($query){
                $query->whereHas('produitTransforme');
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
            'moyen_payement.string' => 'Le moyen de payement doit être une chaîne de caractères.',
            'moyen_payement.required' => 'Un moyen de payement est requis.',
            'moyen_payement.max' => 'Le moyen de payement ne doit pas dépasser :max caractères.',
            'moyen_payement.in' => 'Le moyen de paiement que vous sélectionnez est invalide.',
           
        ];

        $validator = Validator::make($request->all(), [
            'moyen_payement' => ['required', 'string','max:40', Rule::in($validPayments)],
            // 'status_vente' => ['required', 'string','max:11', Rule::in($validesStatusVente)],
        ],
        $messages
    );
        
        

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        try{
            $vente = Ventes::findOrFail($request->vente_id);
            $vente->moyen_payement = $request->moyen_payement;

            if($vente->update()){
                return response()->json(["SUCCES!"=>true]);
            }
            return response()->json("Une erreur s'est produite.");
        }catch(\Exception $e){
          
        }
       
    }

    public function delete($id){
        try {
            $vente = Ventes::findOrFail($id);

            foreach ($vente->lignesVente as $ligneVente) {
                $ligneVente->delete();
            }

            $vente->delete();
            return redirect()->back()->with('success', 'Vente supprimée!');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Vente non trouvée!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la suppression!');
        }
    }

    public function store(Request $request){

        $rules = [
            'produits.*' => 'required|string|max:60',
            'quantite_envoyee.*' => 'nullable|integer|min:0',
            'quantite_vendue.*' => 'required|integer|min:0',
            'prix_vente.*' => 'required|numeric|min:0',
            'montant_regle.*' => 'required|numeric|min:0',
            'ligne_client_systeme' => 'min:1',
            'type_de_vente' => ['required', 'string', Rule::in(['Dépôt vente', 'À crédit', 'Au comptant'])],
            'moyen_payement' => ['required', 'string', Rule::in(['Payement BIICF', 'Cash', 'Wave', 'Orange money','Moov money','MTN money','Trasor money'])],
        ];

        $messages = [
            'produits.*.required' => 'Le produit est requis.',
            'ligne_client_systeme.min' => 'Le client choisi presente un problème.',
            'quantite_vendue.*.required' => 'La quantité vendue est requise.',
            'prix_vente.*.required' => 'Le prix de vente est requis.',
            'prix_vente.*.numeric' => 'Le prix de vente doit être un nombre.',
            'montant_regle.*.numeric' => 'Le montant réglé doit être un nombre.',
            'montant_regle.*.required' => 'Un montant est requis.',
            'type_de_vente.required' => 'Un type est requis.',
            'moyen_payement.required' => 'Un moyen de payement est requis',
            'type_de_vente.in' => 'Le type de vente que vous sélectionnez est invalide.',
            'moyen_payement.in' => 'Le type de vente que vous sélectionnez est invalide.',
        ];


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        
        if($request->type_de_vente == "Dépôt vente"){
            if(!$request->ligne_client_systeme){
                return response()->json(['clientRequis' =>true]);
            }

            foreach ($request->produits as $index => $produit) {
                $livraison = Livraisons::where('ligne_client_systeme_id', $request->ligne_client_systeme)
                    ->where('produit_transforme_id', $produit)
                    ->firstOrFail();
                if($livraison->quantite_livree < $request->quantite_vendue[$index]){
                    return response()->json(['quatiteLivreeInsuffisante' => ++$index]);
                }
            }
        }

        $newVente = Ventes::create(
            [
              'reference' => $this->generateReference(MainClass::getSystemId(), 'REFVT'),
              'moyen_payement' => $request->moyen_payement,
              'status_vente' => 'Confirmée',
              'type_vente' => 'Produits transformés',
              'ligne_client_systeme_id' => $request->ligne_client_systeme,
            ]
        );
  
        foreach ($request->produits as $index => $produit) {
            $produitTransforme = ProduitTransforme::find($produit);
            if($request->quantite_envoyee[$index]){
                if($request->quantite_envoyee[$index]<$request->quantite_vendue[$index]){
                    return response()->json(['quantiteInsufisante'=> $index]);
                };
            }
            try {
                $livraison = Livraisons::where('ligne_client_systeme_id', $request->ligne_client_systeme)
                    ->where('produit_transforme_id', $produit)
                    ->firstOrFail();
                    $livraison->quantite_livree -= $request->quantite_vendue[$index];
                    if($livraison->quantite_livree == 0){
                        $livraison->geree = 1;
                    }
                    $livraison->update();
            } catch (\Exception $e) {}

            $lignevente = LigneVente::create([
                'produit_transforme_id' => $produit,
                'type_de_produit_a_vendre' => "Produits transformés",
                'vente_id' => $newVente->id,
                'quantite_envoyee' => $request->quantite_envoyee[$index],
                'quantite_vendue' => $request->quantite_vendue[$index],
                'prix_reel_vente' => $request->prix_reel_vente[$index],
                'prix_vente' => $request->prix_vente[$index],
                'montant_regle' => $request->montant_regle[$index] ?? 0,
            ]);

            if($lignevente){
                $diff = $request->prix_vente[$index] * $request->quantite_vendue[$index] - $request->montant_regle[$index];
                if($diff > 0){
                    DettesClients::create([
                        'montant' => $diff,
                        'ligne_vente_id' => $lignevente->id,
                    ]);
                }

                $qts = $produitTransforme->qte_en_portions;
                $produitTransforme->qte_en_portions = $qts - $request->quantite_vendue[$index];
                $produitTransforme->update();
            }
        }

        if ($newVente->lignesVente->count() == 0) {
            $newVente->deleteOrFail();
        }
        return response()->json(['message' => "Vente ajoutée avec succès."]);
    }
}
