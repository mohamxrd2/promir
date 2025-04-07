<?php
namespace App\Http\Controllers;
use App\Classes\MainClass;
use App\Http\Controllers\Controller;
use App\Models\LigneClientSysteme;
use App\Models\Livraisons;
use App\Models\ProduitTransforme;
use App\Models\System_produit;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class LivraisonsController extends Controller
{
    public function index(){
        $livraisons = Livraisons::whereHas('ligneClientSysteme', function($query) {
            $query->where('system_client_id', MainClass::getSystemId());
        })->where('annulee', false)->where('geree', false)->with(['systemProduit.produit.categorie', 'produitTransforme', 'ligneClientSysteme.client'])->get();
        // $produits = System_produit::with('produit')->where('system_client_id', MainClass::getSystemId())->get();
        $clients = LigneClientSysteme::with('client')->where('system_client_id', MainClass::getSystemId())->get();
        return view('livraisons.livraisons', compact(['livraisons', 'clients']));
    }

    public function store(Request $request){
        $rules = [
            'produitsSelect2' => 'required|string',
            'clientSelect2' => 'required|string',
            'quantite_livree' => 'required|numeric|min:1',
            'type_de_produits' => ['required', 'string', Rule::in(['Produit transformé', 'Produit non transformé'])],
        ];

        $messages = [
            'produitsSelect2.required' => 'Le produit est requis',
            'clientSelect2.required' => 'Le client est requis.',
            'type_de_produits.required' => 'Le Type de produit est requis',
            'quantite_livree.required' => 'La quantité est requise',
            'quantite_livree.min' => 'La quanité est incorrecte',
            'quantite_livree.numeric' => 'La quanité doit être un nombre',
            'type_de_produits.in' => 'Ce type est invalide',
        ];


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        
        $type_de_produits = $request->type_de_produits;

        if($type_de_produits == "Produit non transformé" ){
            $produitConcerne = System_produit::find($request->input('produitsSelect2'));
            if($produitConcerne->qte_stck < $request->quantite_livree){
                return response()->json(['quantiteInsuffisante' =>true]);
            }

            $livraison = null;
            try {
                $livraison = Livraisons::where('ligne_client_systeme_id', $request->clientSelect2)
                    ->where('system_produit_id', $request->produitsSelect2)
                    ->firstOrFail();
            } catch (ModelNotFoundException $e) {
                $livraison = null; // la livraison reste null
            }
            
            if ($livraison != null){
                $livraison->quantite_livree += $request->quantite_livree;
                $livraison->geree = 0;
                $livraison->update();
            }else if($livraison == null){
                $livraison =  Livraisons::create([
                    'quantite_livree' => $request->quantite_livree,
                    'system_produit_id' => $request->produitsSelect2,
                    'produit_transforme_id' => null,
                    'ligne_client_systeme_id' => $request->clientSelect2,
                ]);
            }
               
            if($livraison != null){
                $produitConcerne->qte_stck -= $request->quantite_livree;
                $produitConcerne->update();
            }
                
            return response()->json(['message' => "Livraison créée avec succès."]);
        }elseif($type_de_produits == "Produit transformé"){
            $produitConcerne = ProduitTransforme::find($request->input('produitsSelect2'));
            if($produitConcerne->qte_en_portions < $request->quantite_livree){
                return response()->json(['quantiteInsuffisante' =>true]);
            }

            $livraison = null;
            try {
                $livraison = Livraisons::where('ligne_client_systeme_id', $request->clientSelect2)
                    ->where('produit_transforme_id', $request->produitsSelect2)
                    ->firstOrFail();
            } catch (ModelNotFoundException $e) {
                $livraison = null; // la livraison reste null
            }
            
            if ($livraison != null){
                $livraison->quantite_livree += $request->quantite_livree;
                $livraison->update();
            }else if($livraison == null){
                $livraison =  Livraisons::create([
                    'quantite_livree' => $request->quantite_livree,
                    'produit_transforme_id' => $request->produitsSelect2,
                    'system_produit_id' => null,
                    'ligne_client_systeme_id' => $request->clientSelect2,
                ]);
            }
               
            if($livraison != null){
                $produitConcerne->qte_en_portions -= $request->quantite_livree;
                $produitConcerne->update();
            }
            return response()->json(['message' => "Votre livraison a bien été enregistré."]);
        }
        return response()->json(["message" => "Livraison non aboutie! Veuillez recommencer..."]);
    }




    public function delete($id){
        try {
            $vente = Livraisons::findOrFail($id);
            $vente->delete();
            return redirect()->back()->with(toastr()->success('Supression terminée!'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with(toastr()->error('Livraison non trouvée!'));
        }
    }

    public function annuler($id){
        try {
            $livraison = Livraisons::with(['systemProduit', 'produitTransforme'])->findOrFail($id);
            $livraison->annulee = true;
            $livraison->update(['systemProduit', 'produitTransforme']);


            $produitConcerne = $livraison->systemProduit?$livraison->systemProduit:$livraison->produitTransforme;
           

            return redirect()->back()->with(toastr()->success('Livraison annulée!'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with(toastr()->error('Livraison non trouvé!'));
        }
    }


    public function edite(Request $request){

        $validator = Validator::make($request->all(), [
            'quantite_livree' => 'numeric|required|min:1|max:9999999999',
            'id_livraison' => 'required|exists:livraisons,id',
        ], [
            'quantite_livree.numeric' => 'La quantité livrée doit être un nombre',
            'quantite_livree.required' => 'La quantité est requise',
            'quantite_livree.min' => 'Valeur non valide.',
            'quantite_livree.max' => 'Valeur trop grande (limite: :max)',
            'id_livraison.exists' => 'Cette livraison rencontre un problème',
            'id_livraison.required' => 'Cette livraison rencontre un problème',
        ]);
    
    

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        
        $table = Livraisons::findOrFail($request->id_livraison);
        $table->quantite_livree = $request->quantite_livree;

        if($table->update()){
            return response()->json(["SUCCES!"=>true]);
        }
        return response()->json("Une erreur s'est produite.");
    }



    public function renderElementALivrer (Request $request) {
        try{
            $system_id = MainClass::getSystemId();
            if($request->type_produit == 'Produit non transformé'){
                $produits_brut = System_produit::where('system_client_id', $system_id)->with('produit')->orderBy('created_at')->get();
                return response()->json(['produits_brut' => $produits_brut]);
            }elseif($request->type_produit == 'Produit transformé'){
                $produits_transformes = ProduitTransforme::whereHas('productions.produitsBruts.systemeClient', function ($query) use ($system_id) {
                    $query->where('id', $system_id);
                })->get();
                return response()->json(['produits_transformes' => $produits_transformes]);
            }
            
            
        }catch(\Exception $e){
            return response()->json(['other_error' => true]);
        }
        
    }
    
    public function renderElementProperties (Request $request) {
        try{
            $query = request()->query('query');
            if($request->type_produit == 'Produit non transformé'){
                $produit = System_produit::with('produit')->findOrFail($query);
                return response()->json(['produit_brut' =>$produit]);
            }elseif($request->type_produit == 'Produit transformé'){
                $produit = ProduitTransforme::findOrFail($query);
                return response()->json(['produit_transforme' =>$produit]);
            }
        }catch(\Exception $e){
            return response()->json(['other_error' => true]);
        }
    }
}