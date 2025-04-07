<?php

namespace App\Http\Controllers;

use App\Classes\MainClass;
use App\Http\Controllers\Controller;
use App\Models\Clients;
use App\Models\LigneClientSysteme;
use App\Models\LigneVente;
use App\Models\Livraisons;
use App\Models\ProduitTransforme;
use App\Models\Services;
use App\Models\System_produit;
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

    public function index()

    {
        $today = Carbon::today();
        $systemId = MainClass::getSystemId();
        $system_id = auth()->user()->system_client->id;
        $mesClients = LigneClientSysteme::where("system_client_id", $system_id)
            ->whereHas('ventes', function($query) use ($today) {
                $query->whereDate('created_at', $today);
            })
            ->with(['ventes' => function($query) use ($today) {
                $query->whereDate('created_at', $today)
                    ->orderBy('created_at', 'desc')
                    ->with('lignesVente');
            }])
            ->get();
            $produits_brut = System_produit::where('system_client_id', $system_id)->with('produit')->orderBy('created_at')->get();
            $cls = Clients::select('clients.*')
                ->leftJoin('ligne_client_systemes as lcs', function($join) use ($systemId) {
                    $join->on('clients.id', '=', 'lcs.client_id')
                        ->where('lcs.system_client_id', '=', $systemId);
                })
                ->whereNull('lcs.client_id')
                ->get();

        $clients = LigneClientSysteme::with('client')->where('system_client_id', $system_id)->orderBy('created_at')->get();
        return view("ventes.vente-produit-brut", compact(["mesClients", "clients", "cls", "produits_brut"]));
    }

    public function renderLignesVenteForDetailsOfVente(Request $request){
        $id_vente = request()->query('query');
        $vente = Ventes::with(['lignesVente.systeme_produit.produit', 'lignesVente.service', 'lignesVente.produit_transf'])->findOrFail($id_vente);
        $lignesVente = $vente->lignesVente;
        return response()->json(['lignesVente' => $lignesVente]);
    }


    public function renderElementVente () {
        try{
            $type_vente = request()->query('type_vente');
            $system_id = auth()->user()->system_client->id;

            if($type_vente == "Vente service" ){

                $services = Services::where('system_client_id', $system_id)->orderBy('created_at')->get(['id','reference', 'designation', 'prix_unitaire']);
                return response()->json(['services' => $services]);

            }elseif($type_vente == "Vente produit non transformé"){
                
                $produits_brut = System_produit::where('system_client_id', $system_id)->with('produit')->orderBy('created_at')->get();
                return response()->json(['produits_brut' => $produits_brut]);

            }elseif($type_vente == "Vente produit transformé"){
                $produits_transformes = ProduitTransforme::whereHas('produitsBruts', function($query) use ($system_id) {
                    $query->where('system_client_id', $system_id);
                })->get();
                return response()->json(['produits_transformes' => $produits_transformes]);
            }else {
                return response()->json(['type_error' => true]);
            }
        }catch(\Exception $e){
            return response()->json(['other_error' => true]);
        }
        
    }


    public function productPropertiesForVente(Request $request){
        $type_vente = $request->input('type_vente');
        $id_produit_service_pb = $request->input('id_produit_service_pb');
        if($type_vente == "Vente service"){
            $service = Services::where('id', $id_produit_service_pb)->firstOrFail();
            return response()->json(['service' => $service]);
        }elseif($type_vente == "Vente produit non transformé"){
            $produit_brut = System_produit::with('produit')->where('id', $id_produit_service_pb)->firstOrFail();

            $totalQuantiteLivree = Livraisons::where('ligne_client_systeme_id', $request->input('ligne_client'))
                                            ->where('system_produit_id', $id_produit_service_pb)
                                            ->where('geree', false)
                                            ->where('annulee', false)
                                            ->sum('quantite_livree');
                                            

            return response()->json(['produit_brut' => $produit_brut, 'totalQuantiteLivree'=>$totalQuantiteLivree]);
        }elseif($type_vente == "Vente produit transformé"){
            $produit_transforme = ProduitTransforme::where('id', $id_produit_service_pb)->firstOrFail();
            $totalQuantiteLivree = Livraisons::where('ligne_client_systeme_id', $request->input('ligne_client'))
                                            ->where('produit_transforme_id', $id_produit_service_pb)
                                            ->where('geree', false)
                                            ->where('annulee', false)
                                            ->sum('quantite_livree');
            return response()->json(['produit_transforme' => $produit_transforme, 'totalQuantiteLivree'=>$totalQuantiteLivree]);
            
        }else {
            return response()->json(['type_error' => true]);
        }
    }


    public function rechercherElementVente () {
        $type_vente = request()->query('type_produits');
        $terme = "%" . request()->query('query')."%";
        try{
            $system_id = auth()->user()->system_client->id;

            if($type_vente == "Vente service"){

                $services = Services::where('reference', 'like', $terme)
                ->orWhere('designation', 'like', $terme)
                ->where('system_client_id', $system_id)->orderBy('created_at')->get(['id','reference', 'designation', 'prix_unitaire']);
                return response()->json(['services' => $services]);

            }elseif($type_vente == "Vente produit non transformé"){
                
                $produits_brut = System_produit::whereHas('produit', function($query) use ($terme){
                    $query->where('reference', 'like', $terme)->orWhere('designation', 'like', $terme);
                })
                ->where('system_client_id', $system_id)->with('produit')->orderBy('created_at')->get();
                return response()->json(['produits_brut' => $produits_brut]);
            }elseif($type_vente == "Vente produit transformé"){
                
                $produits_transformes = ProduitTransforme::whereHas('produitsBruts', function($query) use ($system_id, $terme) {
                    $query->where('system_client_id', $system_id)->where('reference', 'like', $terme)->orWhere('designation', 'like', $terme);
                })->get();

                return response()->json(['produits_transformes' => $produits_transformes]);
            }else {
                return response()->json(['type_error' => true]);
            }
        }catch(\Exception $e){
            return response()->json(['other_error' => $e]);
        }
        
    }


    
public function rechercherLignesClientsParInput(){
    $q = request()->query('query');
    $terme = "%$q%";


    $clientTrouve = LigneClientSysteme::whereHas('client', function ($query) use ($terme) {
        $query->where('nom', 'like', $terme)
        ->orWhere('phone', 'like', $terme)
        ->orWhere('email', 'like', $terme);
    })->where('system_client_id', MainClass::getSystemId())->with('client')->get();

    return response()->json($clientTrouve);
}


    public function edite(Request $request){
        $validPayments = ['Payement BIICF', 'Cash', 'Wave', 'Orange money', 'Moov money', 'MTN money', 'Trasor money'];
        $validesStatusVente = ['En attente', 'Conifimée', 'Annulée'];
        $messages = [
            'reference.required' => 'Une reference est requise.',
            'reference.string' => 'La reference doit être une chaîne de caractères.',
            'reference.max' => 'La reference ne doit pas dépasser :max caractères.',
            'reference.unique' => 'Cette est indisponible.',
            'moyen_payement.string' => 'Le moyen de payement doit être une chaîne de caractères.',
            'moyen_payement.required' => 'Un moyen de payement est requis.',
            'moyen_payement.max' => 'Le moyen de payement ne doit pas dépasser :max caractères.',
            'moyen_payement.in' => 'Le moyen de paiement que vous sélectionnez est invalide.',
            'status_vente.required' => 'Le status est requis.',
            'status_vente.string' => 'Le status doit être une chaîne de caractères.',
            'status_vente.max' => 'Le status ne doit pas dépasser :max caractères.',
            'status_vente.in' => 'Le status de vente que vous sélectionnez est invalide.',
        ];

        $validator = Validator::make($request->all(), [
            'reference' => 'required|string|max:40|unique:ventes,reference,' .$request->vente_id,
            'moyen_payement' => ['required', 'string','max:40', Rule::in($validPayments)],
            'status_vente' => ['required', 'string','max:11', Rule::in($validesStatusVente)],
        ],
        $messages
    );
        
        

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $vente = Ventes::findOrFail($request->vente_id);
        
        $vente->reference = $request->reference;
        $vente->moyen_payement = $request->moyen_payement;
        $vente->status_vente = $request->status_vente;

        if($vente->update()){
            return response()->json(["SUCCES!"=>true]);
        }
        return response()->json("Une erreur s'est produite.");
    }

    public function delete($id){
        try {
            $vente = Ventes::findOrFail($id);
            $vente->delete();
            return redirect()->back()->with(toastr()->success('Vente supprimée!', 'OK'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with(toastr()->error('Vente non trouvée!', 'Erreur'));
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
            'type_de_produits_a_vendre' => ['required', 'string', Rule::in(['Vente produit transformé', 'Vente produit non transformé', 'Vente service'])],
            'type_de_vente' => ['required', 'string', Rule::in(['Vente locale', 'Vente extérieur'])],
            'moyen_payement' => ['required', 'string', Rule::in(['Payement BIICF', 'Cash', 'Wave', 'Orange money','Moov money','MTN money','Trasor money'])],
            'status_vente' => ['required', 'string', Rule::in(['En attente', 'Conifimée', 'Annulée'])],
        ];

        $messages = [
            'produits.*.required' => 'Le produit est requis.',
            'ligne_client_systeme.min' => 'Le client choisi presente un problème.',
            'quantite_vendue.*.required' => 'La quantité vendue est requise.',
            'prix_vente.*.required' => 'Le prix de vente est requis.',
            'prix_vente.*.numeric' => 'Le prix de vente doit être un nombre.',
            'montant_regle.*.numeric' => 'Le montant réglé doit être un nombre.',
            'montant_regle.*.required' => 'Un montant est requis.',
            'type_de_produits_a_vendre.in' => 'Le type de produits que vous sélectionnez est invalide.',
            'type_de_vente.in' => 'Le type de vente que vous sélectionnez est invalide.',
            'moyen_payement.in' => 'Le type de vente que vous sélectionnez est invalide.',
            'status_vente.in' => 'Le status de vente de vente que vous definissez est invalide.',
        ];


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        

        
        $type_vente = $request->type_de_produits_a_vendre;
        
        $newVente = Ventes::create(
            [
              'reference' => $this->generateReference(MainClass::getSystemId(), 'REFVT'),
              'moyen_payement' => $request->moyen_payement,
              'status_vente' => $request->status_vente,
              'type_vente' => $type_vente,
              'ligne_client_systeme_id' => $request->ligne_client_systeme ?? null,
            ]
        );


        if($type_vente == "Vente service" ){

            foreach ($request->produits as $index => $produit) {
                if($request->quantite_envoyee[$index]){
                    if($request->quantite_envoyee[$index]<$request->quantite_vendue[$index]){
                        return response()->json(['quantiteInsufisante'=> $index]);
                    };
                }
               
                LigneVente::create([
                    'service_id' => $produit,
                    'type_de_produit_a_vendre' => $type_vente,
                    'vente_id' => $newVente->id,
                    'quantite_envoyee' => $request->quantite_envoyee[$index] ?? null,
                    'quantite_vendue' => $request->quantite_vendue[$index] ?? 0,
                    'prix_vente' => $request->prix_vente[$index] ,
                    'montant_regle' => $request->montant_regle[$index] ?? 0,
                ]);
            }
            return response()->json(['message' => "Vente ajoutée avec succès."]);

        }elseif($type_vente == "Vente produit non transformé"){
            
            foreach ($request->produits as $index => $produit) {
                if($request->quantite_envoyee[$index]){
                    if($request->quantite_envoyee[$index]<$request->quantite_vendue[$index]){
                        return response()->json(['quantiteInsufisante'=> $index]);
                    };
                }
                $lignevente = LigneVente::create([
                    'system_produit_id' => $produit,
                    'type_de_produit_a_vendre' => $type_vente,
                    'vente_id' => $newVente->id,
                    'quantite_envoyee' => $request->quantite_envoyee[$index],
                    'quantite_vendue' => $request->quantite_vendue[$index],
                    'prix_vente' => $request->prix_vente[$index],
                    'montant_regle' => $request->montant_regle[$index] ?? 0,
                ]);
                if($lignevente){
                    $produit_brut = System_produit::find($produit);
                    $qts = $produit_brut->qte_stck;
                    $produit_brut->qte_stck = $qts - $request->quantite_vendue[$index];
                    $produit_brut->update();
                }
            }
            return response()->json(['message' => "Vente ajoutée avec succès."]);

        }elseif($type_vente == "Vente produit transformé"){
            foreach ($request->produits as $index => $produit) {
                LigneVente::create([
                    'produit_transforme_id' => $produit,
                    'type_de_produit_a_vendre' => $type_vente,
                    'vente_id' => $newVente->id,
                    'quantite_envoyee' => $request->quantite_envoyee[$index],
                    'quantite_vendue' => $request->quantite_vendue[$index],
                    'prix_vente' => $request->prix_vente[$index],
                    'montant_regle' => $request->montant_regle[$index] ?? 0,
                ]);
            }
            return response()->json(['message' => "Vente ajoutée avec succès."]);
        }



        


        
        return response()->json(["message" => "Ajout éffectué avec succès."]);
    }



}
