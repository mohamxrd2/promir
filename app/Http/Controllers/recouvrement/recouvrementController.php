<?php

namespace App\Http\Controllers\recouvrement;

use App\Http\Controllers\Controller;
use App\Models\ImpayeVente;
use App\Models\Recouvrement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class recouvrementController extends Controller
{

    private function rules(){
        return [
            'somme' => 'required|numeric|max:9999999999|min:0.00001',
            'reference' => 'nullable|max:255|unique:recouvrements,reference',
            'fichier_joint' => 'nullable|file|mimes:pdf,png,jpeg,jpg|max:2048', // 2MB Max
        ];
    }
    
    private function messages(){
        return [
            'somme.required' => 'Montant requis',
            'somme.max' => 'Somme trop grande',
            'somme.min' => 'Somme trop petite',
            'somme.numeric' => 'Nombre requis',
            'reference.max' => 'Max de :max caractères requis',
            'reference.unique' => 'Déjà utilisée',
            'fichier_joint.file' => 'Fichier invalide',
            'fichier_joint.mimes' => 'Types valides: :values',
            'fichier_joint.max' => '2MB Max',
        ];
    }

    public function addRecouvrement(Request $request) {
        $validator = Validator::make($request->all(), $this->rules(), $this->messages());
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        if(!$request->freference && !$request->hasFile('fichier_joint')){
            return response()->json(["problemeDeTraçabilite" => true]);
        }

        
        $recouvrement = Recouvrement::create([
            'somme'=> $request->somme,
            'impaye_vente_id'=> $request->idImpaye,
        ]);

        if($recouvrement){
            $impaye = ImpayeVente::whereHas('ligneVente.systemeProduit')->with('ligneVente')->find($request->idImpaye);
            if($request->somme > $impaye->somme){
                return response()->json(["depassementDeMontant" => true]);
            }

            $somme = $impaye->somme - $request->somme;
            $status = $somme == 0 ? 'Reglé' : 'En cours';
            
            
            $impaye->update([
                'somme' => $somme,
                'status' => $status,
            ]);

            $ligneVente = $impaye->ligneVente;
            $ligneVente->montant_regle += $request->somme;
            $ligneVente->update();
        }
        
        
        if ($request->filled('reference')) {
            $recouvrement = recouvrement::find($recouvrement->id);
            $recouvrement->reference = $request->reference;
            $recouvrement->update();
        }

        if ($request->hasFile('fichier_joint')) {
            $filePath = $request->file('fichier_joint')->store('recouvrementFiles', 'public');
            $recouvrement = recouvrement::find($recouvrement->id);
            $recouvrement->fichier_joint =  $filePath;
            $recouvrement->update();
        }

       return response()->json(["ok" => true]);
    }
    
    public function addRecouvrementPT(Request $request) {
        $validator = Validator::make($request->all(), $this->rules(), $this->messages());
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        if(!$request->reference && !$request->hasFile('fichier_joint')){
            return response()->json(["problemeDeTraçabilite" => true]);
        }

        
        $recouvrement = Recouvrement::create([
            'somme'=> $request->somme,
            'impaye_vente_id'=> $request->idImpaye,
        ]);

        if($recouvrement){
            $impaye = ImpayeVente::whereHas('ligneVente.produitTransforme')->with('ligneVente')->find($request->idImpaye);
            if($request->somme > $impaye->somme){
                return response()->json(["depassementDeMontant" => true]);
            }

            $somme = $impaye->somme - $request->somme;
            $status = $somme == 0 ? 'Reglé' : 'En cours';
            
            $impaye->update([
                'somme' => $somme,
                'status' => $status,
            ]);

            $ligneVente = $impaye->ligneVente;
            $ligneVente->montant_regle += $request->somme;
            $ligneVente->update();
        }
        
        
        if ($request->filled('reference')) {
            $recouvrement = recouvrement::find($recouvrement->id);
            $recouvrement->reference = $request->reference;
            $recouvrement->update();
        }

        if ($request->hasFile('fichier_joint')) {
            $filePath = $request->file('fichier_joint')->store('recouvrementFiles', 'public');
            $recouvrement = recouvrement::find($recouvrement->id);
            $recouvrement->fichier_joint =  $filePath;
            $recouvrement->update();
        }

       return response()->json(["ok" => true]);
    }



    public function addRecouvrementService(Request $request) {
        $validator = Validator::make($request->all(), $this->rules(), $this->messages());
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        if(!($request->filled('reference')) && !($request->hasFile('fichier_joint'))){
            return response()->json(["problemeDeTraçabilite" => true]);
        }

        
        $recouvrement = Recouvrement::create([
            'somme'=> $request->somme,
            'impaye_vente_id'=> $request->idImpaye,
        ]);

        if($recouvrement){
            $impaye = ImpayeVente::whereHas('ligneVente.service')->with('ligneVente')->find($request->idImpaye);
            if($request->somme > $impaye->somme){
                return response()->json(["depassementDeMontant" => true]);
            }

            $somme = $impaye->somme - $request->somme;
            $status = $somme == 0 ? 'Reglé' : 'En cours';

            $impaye->update([
                'somme' => $somme,
                'status' => $status,
            ]);


            $ligneVente = $impaye->ligneVente;
            $ligneVente->montant_regle += $request->somme;
            $ligneVente->update();
        }
        
        
        if ($request->reference) {
            $recouvrement = recouvrement::find($recouvrement->id);
            $recouvrement->reference = $request->reference;
            $recouvrement->update();
        }

        if ($request->hasFile('fichier_joint')) {
            $filePath = $request->file('fichier_joint')->store('recouvrementFiles', 'public');
            $recouvrement = recouvrement::find($recouvrement->id);
            $recouvrement->fichier_joint =  $filePath;
            $recouvrement->update();
        }

       return response()->json(["ok" => true]);
    }
}
