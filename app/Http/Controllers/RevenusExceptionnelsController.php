<?php

namespace App\Http\Controllers;

use App\Classes\MainClass;
use App\Models\RevenuExceptionnel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class RevenusExceptionnelsController extends Controller
{
    public function index(){
        $revenus_exceptionnels = RevenuExceptionnel::where('system_client_id', MainClass::getSystemId())->orderBy('montant')->get();
        return view('revenus.revenus_exceptionnels', compact(['revenus_exceptionnels']));
    }


    public function delete($id){
        try {
            $revenu = RevenuExceptionnel::findOrFail($id);
            $revenu->delete();
            return redirect()->back()->with(toastr()->success('Revenu supprimé avec succès!'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with(toastr()->error("Revenu non trouvé"));
        }
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), $this->rules(),$this->messages());
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        RevenuExceptionnel::create(
            [
                'libelle' => $request->libelle,
                'montant' => $request->montant,
                'system_client_id' => MainClass::getSystemId(),
            ]
        );
        
        return response()->json(["message" => "Revenu ajouté avec succès"]);
    }



    public function edite(Request $request){
        $validator = Validator::make($request->all(), $this->rules(),$this->messages());
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $revenu = RevenuExceptionnel::findOrFail($request->id_revenu_exceptionnel);
        $revenu->montant = $request->montant;
        if($revenu->update()){
            return response()->json(["SUCCES!"=>true]);
        }
        return response()->json("Une erreur s'est produite.");
    }

    private function rules(){
        return [
            'libelle' => ['required', Rule::in(["Aide", "Crédit TVA","Cession d'actif", "Redevance", "Crédit impôt", "Subvention"])],
            'montant' => 'numeric|required|max:9999999999|min:0.00000001',
            'id_revenu_exceptionnel' => 'sometimes|required|exists:revenu_exceptionnels,id'
        ];
    }

    private function messages(){
        return [
            'libelle.required' => 'Champ requis',
            'libelle.in' => 'Libellé invalide',
            'montant.max' => 'Max dépassé',
            'montant.min' => 'Trop petit',
            'montant.required' => 'Champ requis',
            'montant.numeric' => 'Nombre requis',
            'id_revenu_exceptionnel.exists' => 'Problème inconnu',
        ];
    }
}
