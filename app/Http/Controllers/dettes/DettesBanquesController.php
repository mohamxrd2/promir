<?php

namespace App\Http\Controllers\dettes;

use App\Classes\MainClass;
use App\Http\Controllers\Controller;
use App\Models\Banque;
use App\Models\Dette;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DettesBanquesController extends Controller
{
    private function rules(){
        return [
            'objet' => 'nullable|string|max:190',
            'date_echeance' => 'date|required',
            'date_effet' => 'date|required',
            'periode_de_penalite' => 'string|required',
            'taux_de_penalite' => 'numeric|required',
            'montant' => 'numeric|required|max:9999999999',
            'montant_paye' => 'numeric|required|max:9999999999',
            'banque' => 'integer|required|min:0|exists:banques,id',
        ];
    }
    
    private function messages(){
        return [
            'objet.string' => 'Chaîne de caractères requise',
            'objet.max' => 'Max de :max caractères requise',
            'date_echeance.date' => 'Date requise',
            'date_echeance.required' => 'Champ requis',
            'date_effet.date' => 'Date requise',
            'date_effet.required' => 'Champ requis',
            'periode_de_penalite.string' => 'Chaine uniqement',
            'periode_de_penalite.required' => 'Champ requis',
            'taux_de_penalite.numeric' => 'Nombre uniqement',
            'taux_de_penalite.required' => 'Champ requis',
            'montant.max' => 'Max de :max caractères requise',
            'montant.required' => 'Champ requis',
            'montant.numeric' => 'Nombre requis',
            'montant_paye.max' => 'Max de :max caractères requise',
            'montant_paye.required' => 'Champ requis',
            'montant_paye.numeric' => 'Nombre requis',
            'banque.integer' => 'Un probleme est survenu',
            'banque.required' => 'Un probleme est survenu',
            'banque.min' => 'Un probleme est survenu',
            'banque.exists' => 'Un probleme est survenu',
        ];
    }


    public function index(){
        $systemId = MainClass::getSystemId();
        $banques = Banque::orderBy('nom')->get();
        $dettes = Dette::whereHas('banque')->with('banque')->where('type', 'Dette banques')->where('system_client_id', $systemId)->orderBy('created_at', 'desc')->get();
        return view('dettes.dettes_banques', compact(['dettes', 'banques']));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), $this->rules(), $this->messages() );
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $status = $request->montant - $request->montant_paye == 0 ? 'Reglé' : 'En cours';
        if($request->montant < $request->montant_paye ){
            return response()->json(["erreurMontant" => true]);
        }
        Dette::create([
              'objet' => $request->objet,
              'date_echeance' => $request->date_echeance,
              'date_effet' => $request->date_effet,
              'periode_de_penalite' => $request->periode_de_penalite,
              'taux_de_penalite' => $request->taux_de_penalite,
              'montant' => $request->montant,
              'montant_paye' => $request->montant_paye,
              'type' => "Dette banques",
              'status' => $status,
              'banque_id' => $request->banque,
              'system_client_id' => MainClass::getSystemId(),
            ]
        );
        
        return response()->json(["message" => "Ajout éffectué avec succès."]);
    }


    public function edite(Request $request){
        $validator = Validator::make($request->all(), $this->rules(), $this->messages() );
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        if($request->montant < $request->montant_paye ){
            return response()->json(["erreurMontant" => true]);
        }
        
        $dette = Dette::findOrFail($request->id_dette);
        $status = $request->montant - $request->montant_paye == 0 ? 'Reglé' : 'En cours';
        $dette->objet = $request->objet;
        $dette->date_echeance = $request->date_echeance;
        $dette->date_effet = $request->date_effet;
        $dette->periode_de_penalite = $request->periode_de_penalite;
        $dette->taux_de_penalite = $request->taux_de_penalite;
        $dette->montant = $request->montant;
        $dette->montant_paye = $request->montant_paye;
        $dette->status = $status;
        $dette->banque_id = $request->banque;
        
        if($dette->update()){
            return response()->json(["SUCCES!"=>true]);
        }
        return response()->json("Une erreur s'est produite.");
    }


    public function rechercherBanques () {
        $terme = "%" . request()->query('query')."%";
        try{
            $banquesTrouvees = Banque::where('nom', 'like', $terme)->orWhere('sigle', 'like', $terme)->get();
            return response()->json(['banquesTrouvees' => $banquesTrouvees]);
        }catch(\Exception $e){
            return response()->json(['other_error' => $e]);
        }
        
    }
}