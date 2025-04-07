<?php

namespace App\Http\Controllers;

use App\Classes\MainClass;
use App\Models\Inventaire;
use App\Models\ProduitTransforme;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class InventaireProduitsFinisController extends Controller
{
    public function index() {
        $produits = ProduitTransforme::whereHas('productions.produitsBruts', function($query){
            $query->where('system_client_id', MainClass::getSystemId());
        })->get();
        $inventaires = collect();




        // foreach ($produits as $produit) {
        //     if($produit->inventaires){
        //         $date = $produit->inventaires()->latest()->first()->created_at->format('Y-m-d');
        //         break;
        //     }
        // }

        foreach ($produits as $produit) {
            $inventaires = $inventaires->merge(
                $produit->inventaires()->with('produitable')->whereDate('date_inventaire', Carbon::today()->format('Y-m-d'))->get()
            );
        }
        return view('inventaires.inventaires_marchandises', compact('inventaires', 'produits'));
    }

    public function renderProduitInventorieProperties (Request $request) {
        try{
            $produit = ProduitTransforme::findOrFail($request->idProduit);
            return response()->json($produit);
        }catch(\Exception $e){
            return response()->json(['other_error' => true]);
        }
    }



    public function store(Request $request){
        $rules = [
            'date_inventaire' => 'required|date',
            'produits.*' => 'required|exists:produit_transformes,id',
            'quantite_physique.*' => 'required|numeric|min:0',
        ];


        $messages = [
            'date_inventaire.required' => 'Champ requis',
            'date_inventaire.date' => 'Date requise',

            'produits.*.required' => 'Champ requis',
            'produits.*.exists' => 'Problème inconnu',

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
                    $p = ProduitTransforme::findOrFail($produit);
                }catch(\Exception $e){
                    continue;
                }
                
                if($p){
                    $prix_vente = $p->prix_unitaire_portion;
                    $quantite_theorique = $p->qte_en_portions;
                    $p->inventaires()->create([
                        'date_inventaire' => $request->date_inventaire,
                        'quantite_theorique' => $quantite_theorique,
                        'quantite_physique' => $request->quantite_physique[$index],
                        'prix_unitaire' => $prix_vente,
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
        ];

        $validator = Validator::make($request->all(), [
            'quantite_physique' => 'required|numeric|min:0',
            'date_inventaire' => 'required|date',
        ],
        $messages
    );
        
       
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $inventaire = Inventaire::findOrFail($request->inventaire_id);
        $inventaire->date_inventaire = $request->date_inventaire;
        $inventaire->quantite_physique = $request->quantite_physique;

        if($inventaire->update()){
            return response()->json(["SUCCES"=>true]);
        }
        return response()->json("Une erreur s'est produite.");
    }
}
