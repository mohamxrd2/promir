<?php

namespace App\Http\Controllers\productions;

use App\Http\Controllers\Controller;
use App\Models\Personnel;
use App\Models\Production;
use App\Models\ProductionProduitbrut;
use App\Models\Produit;
use App\Models\System_produit;
use Illuminate\Http\Request;
use App\Classes\MainClass;
use App\Models\Clients;
use App\Models\LigneClientSysteme;
use App\Models\ProduitTransforme;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Ventes;
use Carbon\Carbon;

class ProductionsController extends Controller
{
    public function index() {
        $today = Carbon::today();
        $systemId = MainClass::getSystemId();
        $agents = Personnel::whereHas('contrat')->with('contrat')->where('system_client_id', $systemId)->orderBy('created_at')->get();
        $productions = Production::whereHas('produitsBruts', function ($query) use ($systemId){
            $query->where('system_client_id', $systemId);
        })->whereDate('created_at', Carbon::today())
        ->with(['produitsBruts', 'personnel.contrat'])->with('produitTransforme')->latest()->get();

        $produitTransformes = ProduitTransforme::whereHas('productions.produitsBruts.systemeClient', function ($query) use ($systemId) {
            $query->where('id', $systemId);
        })->get();

        $produitsPresents = System_produit::where('system_client_id', $systemId)->with('produit.categorie')->orderBy('created_at')->get();
        return view("productions.productions", compact(["productions", "produitTransformes", "produitsPresents","agents"]));
    }
 

    public function store(Request $request) {
        $validator = null;
        $produit_transforme_id = null;
        $produit_transforme = null;
        
        try{
            $produit_transforme_id = ProduitTransforme::findOrFail($request->produit_transforme)->id;
            $rules = [
                'nbr_portions' => ['required', 'numeric', 'min:1'],
                'produit_transforme' => ['required', 'numeric', 'min:1'],
                'produit_utilisee.*' => 'required|numeric|min:1',
                'quantite_utilisee.*' => 'required|numeric|min:0.00000001',
            ];
        
            $messages = [
                'produits_utilise.*.required' => 'Champ est requis',
                'produits_utilise.*.max' => 'Max de :max requis',
                'quantite_utilisee.*.required' => 'Champ requis',
                'quantite_utilisee.*.numeric' => 'Doit être un nombre.',
                'quantite_utilisee.*.min' => 'Min de :min requis',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }
        }catch (ModelNotFoundException $e) {
            $produit_tr = ProduitTransforme::where('designation', $request->designationpt)
                ->where('portion_unitaire', $request->portion_unitaire)
                ->where('prix_unitaire_portion', $request->prix_unitaire_portion)
                ->first();
                
            if($produit_tr){
              return response()->json(['duplicationDeProduit' => true]);
            }

            $rules = [
                'designationpt' => ['required', 'string', 'max:60'],
                'portion_unitaire' => ['required', 'string', 'max:60'],
                'prix_unitaire_portion' => ['required', 'numeric', 'max:9000000000' , 'min:0.00001'],

                'nbr_portions' => ['required', 'numeric', 'min:1'],
                'produits_utilise.*' => 'required|string|max:60',
                'quantite_utilisee.*' => 'required|numeric|min:0.00000001',
            ];
        
            $messages = [
                'produits_utilise.*.required' => 'Champ est requis',
                'produits_utilise.*.max' => 'Max de :max requis',
                'quantite_utilisee.*.required' => 'Champ requis',
                'quantite_utilisee.*.numeric' => 'Doit être un nombre.',
                'quantite_utilisee.*.min' => 'Min de :min requis',
                
                'designationpt.required' => 'Champ requis',
                'designationpt.max' => 'Max de :max requis',

                'portion_unitaire.required' => 'Champ requis',
                'portion_unitaire.max' => 'Max de :max requis',


                'prix_unitaire_portion.required' => 'Champ requis',
                'prix_unitaire_portion.max' => 'Max de :max requis',
                'prix_unitaire_portion.numeric' => 'Doit être un nombre.',
                'prix_unitaire_portion.min' => 'Min de :min requis',
            ];


            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            // Creation du produit transformé
            $produit_transforme = ProduitTransforme::create([
                'reference' => MainClass::generateReference('REFPDTT', ProduitTransforme::class),
                'designation' => $request->designationpt,
                'portion_unitaire' => $request->portion_unitaire,
                'prix_unitaire_portion' => $request->prix_unitaire_portion,
                'qte_en_portions' => 0,
            ]);
            $produit_transforme_id = $produit_transforme->id;
        }
    
        try {

            // Création de la production
            $production = Production::create([
                'produit_transforme_id' => $produit_transforme_id,
                'nbr_portions' => $request->nbr_portions,
            ]);
    
            // Attachement des produits bruts
            if($request->produits_utilise){
                foreach ($request->produits_utilise as $index => $produit) {
                    $produit = System_produit::findOrFail($produit);
                    $totalPortions = ($produit->qte_stck ?? 1) * ($produit->nombre_pieces ?? 1) * ($produit->nombre_portions ?? 1);
                    $portionsPrelevees = $request->quantite_utilisee[$index];
                    if ($portionsPrelevees > $totalPortions) {
                        $production->produitsBruts()->detach();
                        $production->personnel()->detach();
                        $production->delete();
                        $i = $index + 1;
                        return response()->json(['quantiteInsufisante' => $i]);
                    }
                    

                    $portionsRestantes = $totalPortions - $portionsPrelevees;
                    // La vraie quantité restante en stock apres prelevement est :  portionsRestantes divisé par (nombre_pieces fois nombre_portions )
                    $qteStckRestant = $portionsRestantes / (($produit->nombre_pieces ?? 1) * ($produit->nombre_portions ?? 1));
                    $produit->qte_stck = $qteStckRestant;
                    $produit->update();
                    $production->produitsBruts()->attach($produit->id, ['quantite_utilisee' => $portionsPrelevees]);
                }
            }


            if($request->employes_utilise){
                foreach ($request->employes_utilise as $index => $employe) {
                    $nombreHeures = ($request->nombreHeures[$index] ?? 0) + ($request->nombreMinutes[$index] ?? 0) / 60;
                    $production->personnel()->attach($employe, [
                        'heures' => $nombreHeures,
                    ]);
                }
            }


            $produit_transforme = ProduitTransforme::findOrFail($produit_transforme_id);
            if($produit_transforme){
                $produit_transforme->qte_en_portions += $request->nbr_portions;
                $produit_transforme->update();
            }


            if ($production->produitsBruts()->count() === 0) {
                $produit_transforme->qte_en_portions -= $request->nbr_portions;
                $produit_transforme->update();
                $production->delete();
            }

            return response()->json(['message' => "Production ajoutée avec succès."]);
    
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Produit non trouvé : ' . $e->getMessage()], 404);
    
        } 
    }





    public function delete($id){
        try {
            $production = Production::findOrFail($id);
            $production->produitsBruts()->detach();
            $production->personnel()->detach();
            $production->delete();
            return redirect()->back()->with(toastr()->success('Production supprimée!'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with(toastr()->error('Production non trouvée!'));
        }catch(\Exception $e){
            return redirect()->back()->with(toastr()->error('Une erreur s\'est produite!'));
        }
        
    }

    public function renderCompositionOfProduction(Request $request){
        
        $idProduction = request()->query('query');
        $production = Production::with(['produitsBruts' => function($query) {
            $query->withPivot(['id', 'quantite_utilisee'])->with('produit');
        }])->findOrFail($idProduction);
        
        $produitsUtilises = $production->produitsBruts;
        return response()->json(['produitsUtilises' => $produitsUtilises]);

    }
    
    public function detach($idProduit,$idProduction){
        try{

            $production = Production::findOrFail($idProduction);
            $production->produitsBruts()->detach($idProduit);

            if ($production->produitsBruts()->count() === 0) {
                $production->delete();
            }

        }catch(\Exception $e ){
            return redirect()->back()->with(toastr()->error("Nous avons rencontré une erreur."));
        }
        
        return redirect()->back()->with(toastr()->success("1 produit retiré avec succès."));

    }

    public function editeProdduitOfProduction(Request $request){

        $validator = Validator::make($request->all(), [
            'nbr_portions' => 'required|numeric|min:1|max:9999999999',
            'idProduit' => 'required|exists:production_produitbruts,id',
        ], [
            'nbr_portions.required' => 'La quantité est requise',
            'nbr_portions.numeric' => 'La quantité doit être un nombre',
            'nbr_portions.min' => 'Valeur non valide.',
            'nbr_portions.max' => 'Valeur trop grande (limite: :max)',
            'idProduit.exists' => 'Problème inconnu',
            'idProduit.required' => 'Problème inconnu',
        ]);
    
    

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        
        $table = ProductionProduitbrut::findOrFail($request->idProduit);

        $table->quantite_utilisee = $request->nbr_portions;

        if($table->update()){
            return response()->json(["SUCCES!"=>true]);
        }
        return response()->json("Une erreur s'est produite.");
    }
}
