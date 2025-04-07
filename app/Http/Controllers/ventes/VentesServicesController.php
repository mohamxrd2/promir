<?php

namespace App\Http\Controllers\ventes;

use App\Classes\MainClass;
use App\Http\Controllers\Controller;
use App\Models\Clients;
use App\Models\ImpayeVente;
use App\Models\LigneClientSysteme;
use App\Models\LigneVente;
use App\Models\ProduitService;
use App\Models\Services;
use App\Models\System_produit;
use App\Models\Ventes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class VentesServicesController extends Controller
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
    public function index(){
        $today = Carbon::today();
        $systemId = MainClass::getSystemId();
        $ventes = Ventes::whereHas('lignClientSystem.systemClient', function ($query) use ($systemId) {
            $query->where('id', $systemId);
        })->whereDate('created_at', Carbon::today())->where('type_vente', 'Services')->with(['lignClientSystem', 'lignesVente.service'])->latest()->get();

        $produitsPresents = Services::where('system_client_id', $systemId)->get();
        $produitsUtilises = System_produit::where('system_client_id', $systemId)->with('produit.categorie')->orderBy('created_at')->get();
        $clientsNonPresents = Clients::select('clients.*')
            ->leftJoin('ligne_client_systemes as lcs', function($join) use ($systemId) {
                $join->on('clients.id', '=', 'lcs.client_id')
                     ->where('lcs.system_client_id', '=', $systemId);
            })
            ->whereNull('lcs.client_id')
            ->get();

        $clientsPresents = LigneClientSysteme::with('client')->where('system_client_id', $systemId)->orderBy('created_at')->get();
        return view("ventes.vente-service", compact(["ventes", "clientsPresents", "clientsNonPresents", "produitsPresents", "produitsUtilises"]));
    }

    public function productPropertiesForVente(Request $request){
        return response()->json(['service' =>  Services::findOrFail($request->input('idProduit'))]);
    }

    public function rechercherElementVente () {
        $terme = "%" . request()->query('query')."%";
        try{
            $services = Services::where('reference', 'like', $terme)
            ->orWhere('designation', 'like', $terme)
            ->where('system_client_id', Mainclass::getSystemId())->orderBy('created_at')->get();
            return response()->json(['services' => $services]);

        }catch(\Exception $e){
            return response()->json(['other_error' => $e]);
        }
        
    }

    public function renderLignesVenteForDetailsOfVente(Request $request){
        $id_vente = request()->query('query');
        $vente = Ventes::with(['lignesVente.service'])->findOrFail($id_vente);
        $lignesVente = $vente->lignesVente;
        return response()->json(['lignesVente' => $lignesVente]);
    }

    public function store(Request $request){

        $rules = [
            'produits.*' => 'required|string|max:60',
            'quantite_vendue.*' => 'required|numeric|min:0',
            'prix_vente.*' => 'required|numeric|min:0',
            'montant_regle.*' => 'required|numeric|min:0',
            'ligne_client_systeme' => 'min:1',
            'type_de_vente.*' => ['required', 'string', Rule::in(['Point de vente', 'Dépôt vente'])],
            'moyen_payement' => ['required', 'string', Rule::in(['Payement BIICF', 'Cash', 'Wave', 'Orange money','Moov money','MTN money','Trasor money'])],
            'quantite_utilisee.*.*' => 'required|numeric|min:0',
            'produits_utilise.*.*' => 'required|min:1|exists:system_produits,id',
        ];

        $messages = [
            'produits.*.required' => 'Le produit est requis.',
            'ligne_client_systeme.min' => 'Le client choisi presente un problème.',
            'quantite_vendue.*.required' => 'La quantité vendue est requise.',
            'quantite_utilisee.*.*.required' => 'Quantité requise',
            'produits_utilise.*.*.required' => 'Produit requis',
            'produits_utilise.*.*.exists' => 'Problème inconnu',
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
        }


        $newVente = Ventes::create(
            [
              'reference' => $this->generateReference(MainClass::getSystemId(), 'REFVT'),
              'moyen_payement' => $request->moyen_payement,
              'status_vente' => 'Conifimée',
              'type_vente' => 'Services',
              'ligne_client_systeme_id' => $request->ligne_client_systeme,
            ]
        );

        foreach ($request->produits as $index => $produit) {
           $lignevente = LigneVente::create([
                'service_id' => $produit,
                'type_de_produit_a_vendre' => "Services",
                'vente_id' => $newVente->id,
                'quantite_vendue' => $request->quantite_vendue[$index] ?? 0,
                'prix_vente' => $request->prix_vente[$index] ,
                'montant_regle' => $request->montant_regle[$index] ?? 0,
            ]);

            
            if($request->produits_utilise){
                foreach($request->produits_utilise[$index] as $cle =>  $produit){
                    $produitService = ProduitService::create([
                        'ligne_vente_id' =>$lignevente->id,
                        'system_produit_id' =>$produit,
                        'quantite_produit' =>$request->quantite_utilisee[$index][$cle],
                    ]);
                    if($produitService){
                        $produitBrut = System_produit::findOrFail($produit);
                        $produitBrut->qte_stck-=$request->quantite_utilisee[$index][$cle];
                        $produitBrut->update();
                    }
                }
            }
        }

        if($lignevente){
            $diff = $request->prix_vente[$index] * $request->quantite_vendue[$index] - $request->montant_regle[$index];
            if($diff > 0){
                $impaye = new ImpayeVente;
                $impaye->somme = $diff;
                $impaye->ligne_vente_id = $lignevente->id;
                $impaye->status = 'En cours';
                $impaye->type = 'Impayé sur service';
                $impaye->save();
            }
        }

        $newVente = Ventes::find($newVente->id);
        if ($newVente->lignesVente->count() == 0) {
            $newVente->deleteOrFail();
        }
        return response()->json(['message' => "Vente ajoutée avec succès."]);
    }

    public function edite(Request $request){
        $validPayments = ['Payement BIICF', 'Cash', 'Wave', 'Orange money', 'Moov money', 'MTN money', 'Trasor money'];
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
        ], $messages );
        

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $vente = Ventes::findOrFail($request->vente_id);
        
        
        $vente->moyen_payement = $request->moyen_payement;
        $vente->status_vente = $request->status_vente;

        if($vente->update()){
            return response()->json(["SUCCES!"=>true]);
        }
        return response()->json("Une erreur s'est produite.");
    }
}
