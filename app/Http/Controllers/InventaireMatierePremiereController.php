<?php

namespace App\Http\Controllers;

use App\Classes\MainClass;
use App\Models\Inventaire;
use App\Models\System_produit;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Validator;

class InventaireMatierePremiereController extends Controller
{
    public function index() {
        $produits = System_produit::where('system_client_id', MainClass::getSystemId())->with('produit.categorie')->get();
        $inventaires = collect();

        // foreach ($produits as $produit) {
        //     if($produit->inventaires){
        //         $date = $produit->inventaires()->latest()->first()->created_at->format('Y-m-d');
        //         break;
        //     }
        // }

        foreach ($produits as $produit) {
            $inventaires = $inventaires->merge(
                $produit->inventaires()->with('produitable.produit')->whereDate('date_inventaire', Carbon::today()->format('Y-m-d'))->get()
            );
        }
        return view('inventaires.inventaires_matiere_premiere', compact('inventaires', 'produits'));
    }


    public function delete($id){
        try {
            $inventaire = Inventaire::findOrFail($id);
            $inventaire->delete();
            return redirect()->back()->with(toastr()->success('Entrée supprimée avec succès'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with(toastr()->error('Entrée non trouvée!'));
        }
    }

    public function renderProduitInventorieProperties (Request $request) {
        try{
            $produit = System_produit::with('produit')->findOrFail($request->idProduit);
            return response()->json($produit);
        }catch(\Exception $e){
            return response()->json(['other_error' => true]);
        }
    }


    public function store(Request $request){
        $rules = [
            'date_inventaire' => 'required|date',
            'produits.*' => 'required|exists:system_produits,id',
            'unites.*' => 'required|numeric|min:0',
            'portions.*' => 'required|numeric|min:0',
            'quantite_physique.*' => 'required|numeric|min:0',
        ];

        $messages = [
            'date_inventaire.required' => 'Champ requis',
            'date_inventaire.date' => 'Date requise',

            'produits.*.required' => 'Champ requis',
            'produits.*.exists' => 'Problème inconnu',

            'unites.*.required' => 'Champ requis',
            'unites.*.numeric' => 'Nombre requis',
            'unites.*.min' => 'Trop petit',
            
            'portions.*.required' => 'Champ requis',
            'portions.*.numeric' => 'Nombre requis',
            'portions.*.min' => 'Trop petit',

            'quantite_physique.*.min' => 'Trop petit',
            'quantite_physique.*.required' => 'Champ requis',
            'quantite_physique.*.numeric' => 'Nombre requis',
        ];


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        
        if($request->produits){
            foreach ($request->produits as $index => $produit) {
                $p = null;
                try{
                    $p = System_produit::findOrFail($produit);
                }catch(\Exception $e){
                    continue;
                }
                
                if($p){
                    $qte = $request->quantite_physique[$index];
                    $de_unite_a_qte = $request->unites[$index] / ($p->nombre_pieces > 0 ? $p->nombre_pieces : 1);
                    $de_portions_a_qte = $request->portions[$index] / (($p->nombre_pieces > 0 ? $p->nombre_pieces : 1 ) * ( $p->nombre_portions > 0 ? $p->nombre_portions : 1));
                    $qte = $qte + $de_unite_a_qte + $de_portions_a_qte;

                    $prix_vente = $p->puv;
                    $quantite_theorique = $p->qte_stck;
                    $p->inventaires()->create([
                        'date_inventaire' => $request->date_inventaire,
                        'quantite_theorique' => $quantite_theorique,
                        'quantite_physique' => $qte,
                        'prix_unitaire' => $prix_vente,
                        'unites' => $request->unites[$index],
                        'portions' => $request->portions[$index],
                    ]);
                }
            }
        }
        
        return response()->json(['OK' => true]);
    }


    public function edite(Request $request){
       
        $messages = [
            'date_inventaire.required' => 'Champ requis',
            'quantite_physique.required' => 'Champ requis',
            'quantite_physique.numeric' => 'Nombre requis',
            'inventaire_id.exists' => 'Problème inconnu',
        ];

        $validator = Validator::make($request->all(), [
            'quantite_physique' => 'required|numeric|min:0',
            'date_inventaire' => 'required|date',
            'inventaire_id' => 'exists:inventaires,id',
        ],
        $messages
    );
        
       
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $inventaire = Inventaire::findOrFail($request->inventaire_id);
        $p = null;
        try{
            $p = $inventaire->produitable;
        }catch(\Exception $e){
            return 0;
        }

        $qte = $request->quantite_physique;
        $de_unite_a_qte = $request->unites / ($request->n_unites > 0 ? $request->n_unites : 1);
        $de_portions_a_qte = $request->portions / (($request->n_unites > 0 ? $request->n_unites : 1 ) * ( $request->n_portions > 0 ? $request->n_portions : 1));
        $qte = $qte + $de_unite_a_qte + $de_portions_a_qte;

        $inventaire->quantite_physique = $qte;
        $inventaire->unites = $request->unites;
        $inventaire->portions = $request->portions;
        $inventaire->date_inventaire = $request->date_inventaire;

        if($inventaire->update()){
            return response()->json(["SUCCES"=>true]);
        }
        return response()->json("Une erreur s'est produite.");
    }
}
