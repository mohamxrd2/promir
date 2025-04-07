<?php

namespace App\Http\Controllers;

use App\Classes\MainClass;
use App\Http\Controllers\Controller;
use App\Models\Caisses;
use App\Models\Operation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class CaissesController extends Controller
{
    public function index(){

        $system_client = auth()->user()->system_client;
        if ($system_client->caisses()->count() == 0) {
            $system_client->caisses()->create(['system_client_id' => $system_client->id]);
        }


        $caisse = $system_client->caisses()->firstOrFail(); 
        $operations = $caisse->operations()->orderBy('created_at', 'desc')->get();
        return view('caisse.caisse', compact(['system_client', 'operations', 'caisse']));
    }


    public function storeOperation(Request $request){
       
        $validator = Validator::make($request->all(), [
            'montant' => 'numeric|required|min:0|max:9999999999',
            'type' => ['required', Rule::in(['Retrait', 'Recharge'])],
        ],
        [
            'montant.numeric' => 'Le montant doit être un nombre',
            'montant.required' => 'Le montant est requis',
            'montant.min' => 'Le montant minimum est de :min',
            'montant.max' => 'Le montant maximum est de :max',
            'type.in' => 'Ce type est invalide.',
            'type.required' => 'Le type est requis',
        ]);
        
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }


        $caisse = Caisses::where('system_client_id', MainClass::getSystemId())->firstOrFail();
        
        if($caisse){
            $caisse_id = $caisse->id;
            $operation = Operation::create(
                [
                  'montant' => $request->montant,
                  'type' => $request->type,
                  'caisse_id' => $caisse_id,
                ]
            );

            if($operation){
                $caisse->solde += $request->type =='Recharge'? $request->montant : -$request->montant;
                $caisse->update();
            }

            $devise = auth()->user()->system_client->devise;
            $message = $request->type == "Recharge" ? "Le rechargement de $request->montant $devise a bien été éffectué." : "Le retrait de $request->montant $devise a bien été éffectué.";
            return response()->json(["message" => $message]);
        }else{
            return response()->json(["message" => "Un problème est survenu."]);
        }
    }


    public function delete($id){
        try {
            $compte = Caisses::findOrFail($id);
            $compte->delete();
            return redirect()->back()->with(toastr()->success('Encaisse supprimée.', 'OK'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with(toastr()->error('Encaisse non trouvée.', 'Erreur'));
        }
    }


    public function edite(Request $request){

        $validator = Validator::make($request->all(), [
            'montant' => 'numeric|required',
        ], [
            'montant.numeric' => 'Le montant doit être un nombre.',
            'montant.required' => 'Le montant est requis.',
        ]);
    
    

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        
        $operation = Operation::findOrFail($request->id_element);
        $caisse = $operation->caisse;
        $montantActuel = $operation->montant;
        if($request->type == "Recharge"){
            $caisse->solde -= $montantActuel;
            $operation->montant = $request->montant;
            $caisse->solde += $request->montant;
        }else{
            $caisse->solde += $montantActuel;
            $operation->montant = $request->montant;
            $caisse->solde -= $request->montant;
        }

        

        if($operation->update()){
            $caisse->save();
            return response()->json(["SUCCES!"=>true]);
        }
        return response()->json("Une erreur s'est produite.");
    }
}
