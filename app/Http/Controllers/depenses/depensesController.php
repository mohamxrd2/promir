<?php

namespace App\Http\Controllers\depenses;

use App\Classes\MainClass;
use App\Http\Controllers\Controller;
use App\Models\Depense;
use App\Models\typesDepense;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class depensesController extends Controller
{
    public function index(){
        $depenses = Depense::with('typeDepense')->where('system_client_id', MainClass::getSystemId())->orderBy('created_at')->get();
        $typeDepense = typesDepense::orderBy('nom')->get();
        return view('depenses.depenses', compact(['depenses', 'typeDepense']));
    }

    private function rules($store,$r = null){
        if($store){
            $rule_reference_payement = 'string|required|max:40|unique:depenses';
        }else{
            $rule_reference_payement = 'string|required|max:40|unique:depenses,reference_payement,'.$r->id_element;
        }
       

        $rules = [
            'reference_payement' => $rule_reference_payement,
            'beneficiaire' => 'string|required',
            'montant' => 'numeric|required|min:0.00000001',
            'montant_regle' => 'numeric|required|min:0',
            'libelle' => 'string|required|max:60',
            'moyen_payement' => 'string|max:40|required',
        ];
        if(!$r->type_depense_input && !$r->type){
            $rules['type'] = ['required'];
        }

        return $rules;

    } 
    private function messages($r){
        

        $messages = [
            'type.required' => 'Un type est requis.',
            'reference_payement.required' => 'La reference de payement est requise.',
            'reference_payement.max' => 'La reference ne doit pas dépasser :max caractères.',
            'montant.numeric' => 'Le montant doit être un nombre.',
            'montant.required' => 'Le montant est requis.',
            'montant.max' => 'Le montant min est de :min.',
            'montant_regle.numeric' => 'Le montant règlé doit être un nombre.',
            'montant_regle.required' => 'Le montant règlé est requis.',
            'montant_regle.min' => 'Le minimum est de :min.',
            'libelle.required' => 'Le libelle est requis.',
            'libelle.max' => 'Le libéllé ne doit pas dépasser :max caractères.',
            'beneficiaire.required' => 'Le beneficiaire est requis.',
            'moyen_payement.required' => 'Le moyen payement est requis.',
            'moyen_payement.max' => 'Le moyen payement ne doit pas dépasser :max caractères.',
            'reference_payement.unique' => 'Erreur: duplication',
        ];

        if(!$r->type_depense_input && !$r->type){
            $messages['type.required'] = 'Un type est requis.';
        }
        return $messages;
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), $this->rules(true, $request) , $this->messages($request));
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        try{
            $typeDepense = typesDepense::find($request->type);
            if($typeDepense){
                $typeId = $typeDepense->id;
            }else{
                $type = typesDepense::create(['nom' => $request->type_depense_input]);
                $typeId = $type->id;
            }
        }catch(ModelNotFoundException $e){
            
        }

        if(!$typeId){return;}
        Depense::create(
            [
              'type_depense_id' => $typeId,
              'libelle' => $request->libelle,
              'montant' => $request->montant,
              'montant_regle' => $request->montant_regle,
              'montant_regle_sur_place' => $request->montant_regle,
              'moyen_payement' => $request->moyen_payement,
              'reference_payement' => $request->reference_payement,
              'beneficiaire' => $request->beneficiaire,
              'system_client_id' => MainClass::getSystemId(),
            ]
        );
        
        return response()->json(["message" => "Ajout éffectué avec succès."]);
    }

    public function edite(Request $request){

        $validator = Validator::make($request->all(), $this->rules(false, $request) , $this->messages($request));
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    
        $depense = Depense::findOrFail($request->id_element);
        $depense->type_depense_id = $request->type;
        $depense->libelle = $request->libelle;
        $depense->montant = $request->montant;
        $depense->montant_regle = $request->montant_regle;
        $depense->montant_regle_sur_place = $request->montant_regle;
        $depense->moyen_payement = $request->moyen_payement;
        $depense->reference_payement = $request->reference_payement;
        $depense->beneficiaire = $request->beneficiaire;
        
        if($depense->update()){
            return response()->json(["SUCCES!"=>true]);
        }
        return response()->json("ERREUR!");
    }

    public function delete($id){
        try {
            $depense = Depense::findOrFail($id);
            $depense->delete();
            return redirect()->back()->with(toastr()->success('Dépense supprimée!'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with(toastr()->error('Dépense non trouvée!'));
        }
    }


    
    public function rechercherTypesParInput(){
        $q = request()->query('query');
        $terme = "%$q%";
        $fundtypes = typesDepense::where('nom', 'like', $terme)->get();

        return response()->json($fundtypes);
    }



}
