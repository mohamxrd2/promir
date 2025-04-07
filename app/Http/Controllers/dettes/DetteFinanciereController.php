<?php

namespace App\Http\Controllers\dettes;

use App\Classes\CalculationsClass;
use App\Classes\MainClass;
use App\Http\Controllers\Controller;
use App\Models\Banque;
use App\Models\DetteFinanciere;
use App\Models\modaliteEchellonneeDetteFinanciere;
use App\Models\modalitePeriodiqueDetteFianciere;
use Illuminate\Http\Request;
use Validator;

class DetteFinanciereController extends Controller
{
    public function index(){
        // dd(CalculationsClass::chagesDirectes('2022-08-23 15:50:37','2025-08-23 15:50:37'));
        $systemId = MainClass::getSystemId();
        $banques = Banque::orderBy('nom')->get();
        $dettes = DetteFinanciere::with(['modalitesEchellonnees', 'modalitePeriodique', 'banque'])->orderBy('created_at', 'desc')->where('system_client_id', $systemId)->orderBy('created_at', 'desc')->get();
        return view('dettes.dettes_financieres', compact(['dettes', 'banques']));
    }

    public function store(Request $request){
        if($request->typeModalite != "Périodique" && $request->typeModalite != "Échelonnée"){ 
            return response()->json(["modaliteTypeError" => true]);
        }
        
        if($request->type_creancier != "Banque" && $request->type_creancier != "Autre"){ 
            return response()->json(["creancierTypeError" => true]);
        }

        $validator = Validator::make($request->all(), $this->rules($request->typeModalite, $request->type_creancier), $this->messages($request->typeModalite, $request->type_creancier));

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        if($request->type_creancier == "Banque"){
            $banque = Banque::findOrFail($request->banque);
            $dette = DetteFinanciere::create([
                'type_creancier' => "Banque",
                'objet' => $request->objet,
                'date_effet' => $request->date_effet,
                'date_echeance' => $request->date_echeance,
                'montant_emprunte' => $request->montant_emprunte,
                'taux_interet' => $request->taux_interet,
                'montant_interet' => $request->montant_interet,
                'taux_de_penalite' => $request->taux_de_penalite,
                'periodicite_de_penalite' => $request->periodicite_de_penalite,
                'system_client_id' => MainClass::getSystemId(),
                'banque_id' => $banque->id,
            ]);
        }elseif($request->type_creancier == "Autre"){
            $dette = DetteFinanciere::create([
                'type_creancier' => "Autre",
                'nom_creancier' => $request->nom_creancier,
                'mail_creancier' => $request->mail_creancier,
                'phone_creancier' => $request->phone_creancier,
                'adresse_creancier' => $request->adresse_creancier,
                'objet' => $request->objet,
                'date_effet' => $request->date_effet,
                'date_echeance' => $request->date_echeance,
                'montant_emprunte' => $request->montant_emprunte,
                'taux_interet' => $request->taux_interet,
                'montant_interet' => $request->montant_interet,
                'taux_de_penalite' => $request->taux_de_penalite,
                'periodicite_de_penalite' => $request->periodicite_de_penalite,
                'system_client_id' => MainClass::getSystemId(),
            ]);
        }

        if($request->typeModalite == "Périodique" && $dette){
            $modalite = modalitePeriodiqueDetteFianciere::create([
                'dette_financiere_id' => $dette->id,
                'montant' => $request->montantARegler[0],
                'periodicite_payement' => $request->periodicite_payement,
                ]);
            if($modalite){
                $dette->update(['manierePayement' => 'Périodique']);
            }
        }elseif($request->typeModalite == "Échelonnée" && $dette){
            $modalite = null;
            foreach ($request->date_reglement as $index => $date) {
                $modalite = modaliteEchellonneeDetteFinanciere::create([
                    'dette_financiere_id' => $dette->id,
                    'montant' => $request->montantARegler[$index],
                    'date_reglement' => $request->date_reglement[$index],
                    ]);
            }

            if($modalite != null){
                $dette->update(['manierePayement' => 'Échelonnée']);
            }
        }
        return response()->json(["message" => "Ajout éffectué avec succès."]);
    }



    public function edite(Request $request){
        if($request->type_creancier != "Banque" && $request->type_creancier != "Autre"){ 
            return response()->json(["creancierTypeError" => true]);
        }
        
        $validator = Validator::make($request->all(), $this->rules($request->typeModalite, $request->type_creancier, true), $this->messages($request->typeModalite, $request->type_creancier, true));
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        
        if($request->type_creancier == "Banque"){
            $dette = DetteFinanciere::findOrFail($request->id_dette);
            $dette->update([
                'type_creancier' => "Banque",
                'objet' => $request->objet,
                'date_effet' => $request->date_effet,
                'date_echeance' => $request->date_echeance,
                'montant_emprunte' => $request->montant_emprunte,
                'taux_interet' => $request->taux_interet,
                'montant_interet' => $request->montant_interet,
                'taux_de_penalite' => $request->taux_de_penalite,
                'periodicite_de_penalite' => $request->periodicite_de_penalite,
            ]);
        }elseif($request->type_creancier == "Autre"){
            $dette = DetteFinanciere::findOrFail($request->id_dette);
            $dette->update([
                'type_creancier' => "Autre",
                'nom_creancier' => $request->nom_creancier,
                'mail_creancier' => $request->mail_creancier,
                'phone_creancier' => $request->phone_creancier,
                'adresse_creancier' => $request->adresse_creancier,
                'objet' => $request->objet,
                'date_effet' => $request->date_effet,
                'date_echeance' => $request->date_echeance,
                'montant_emprunte' => $request->montant_emprunte,
                'taux_interet' => $request->taux_interet,
                'montant_interet' => $request->montant_interet,
                'taux_de_penalite' => $request->taux_de_penalite,
                'periodicite_de_penalite' => $request->periodicite_de_penalite,
            ]);
        }
        return response()->json(["message" => "Ajout éffectué avec succès."]);
    }

    private function rules($typeModalite, $typeCreancier, $edite = false){

        $rules = [
            'date_echeance' => 'date|required',
            'date_effet' => 'date|required',
            'periodicite_de_penalite' => 'string|required',
            'taux_de_penalite' => 'numeric|required',
            'montantARegler.*' => 'numeric|required|max:9999999999',
        ];

        if($edite){  
            $rules['id_dette'] = 'integer|required|exists:dette_financieres,id';
        }

        if($typeModalite == "Périodique"){  
            $rules['periodicite_payement'] = 'string|required';
        }elseif($typeModalite == "Échelonnée"){
            $rules['date_reglement.*'] = 'date|required';
        }
        
        if($typeCreancier == "Banque"){  
            $rules['banque'] = 'integer|required|exists:banques,id';
        }elseif($typeCreancier == "Autre"){
            $rules['type_creancier'] = 'string|required|max:40';
            $rules['nom_creancier'] = 'string|required|max:40';
            $rules['mail_creancier'] = 'string|required|max:40';
            $rules['phone_creancier'] = 'string|required|max:40';
            $rules['adresse_creancier'] = 'string|required|max:40';
        }
        return $rules;
    }
    
    
    private function messages($typeModalite, $typeCreancier, $edite = false){
        $messages = [
            'date_echeance.date' => 'Date valide requise',
            'date_echeance.required' => 'Champ requis',
            'date_effet.date' => 'Date valide requise',
            'date_effet.required' => 'Champ requis',
            'periodicite_de_penalite.string' => 'Chaine uniqement',
            'periodicite_de_penalite.required' => 'Champ requis',
            'taux_de_penalite.numeric' => 'Nombre uniqement',
            'taux_de_penalite.required' => 'Champ requis',
            'montantARegler.*.max' => 'Max de :max caractères requise',
            'montantARegler.*.required' => 'Champ requis',
            'montantARegler.*.numeric' => 'Nombre requis',
        ];

        if($edite){  
            $messages['id_dette.integer'] = 'Un probleme est survenu';
            $messages['id_dette.required'] = 'Choisissez une dette';
            $messages['id_dette.exists'] = 'Un probleme est survenu';
        }
        if($typeModalite == "Périodique"){  
            $messages['periodicite_payement.required'] = 'Champ requis';
        }elseif($typeModalite == "Échelonnée"){
            $messages['date_reglement.*.required'] = 'Champ requis';
            $messages['date_reglement.*.date'] = 'Date valide requise';
        }
        
        if($typeCreancier == "Banque"){  
            $messages['banque.integer'] = 'Un probleme est survenu';
            $messages['banque.required'] = 'Choisissez banque';
            $messages['banque.exists'] = 'Un probleme est survenu';
        }elseif($typeModalite == "Autre"){
            $messages['type_creancier.required'] = 'Champ requis';
            $messages['type_creancier.max'] = 'Max de :max caractères requis';
            
            $messages['nom_creancier.required'] = 'Champ requis';
            $messages['nom_creancier.max'] = 'Max de :max caractères requis';
            
            $messages['mail_creancier.required'] = 'Champ requis';
            $messages['mail_creancier.max'] = 'Max de :max caractères requis';
            
            $messages['phone_creancier.required'] = 'Champ requis';
            $messages['phone_creancier.max'] = 'Max de :max caractères requis';
            
            $messages['adresse_creancier.required'] = 'Champ requis';
            $messages['adresse_creancier.max'] = 'Max de :max caractères requis';
        }
        return $messages;
    }
}
