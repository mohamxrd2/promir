<?php

namespace App\Http\Controllers;

use App\Classes\MainClass;
use App\Http\Controllers\Controller;
use App\Models\Charges;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class ChargesController extends Controller
{
    public function index(){
        $charges = Charges::where('system_client_id', MainClass::getSystemId())->orderBy('libelle')->get();
        return view('charges.charges', compact(['charges']));
    }

    private function rules(){

        $types = ["Fixe", "Quasi fixe", "Variable"];

        $categories = [
            "Coûts externes", 
            "Impôts et taxes", 
            "Autres coûts d'exploitation"
        ];

        $libelles = [
            // Fixe
            "Dépenses de canal", "Fournitures administratives", "Assurances", "Frais de services bancaires",
            "Impôts (autres que l’impôt sur les bénéfices)", "Autres taxes communales", "TVA", "Redevances", "Autres taxes de l'État",
            "Redevances pour licences", "Brevets", "Droits d’auteur",

            // Quasi fixe
            "Dépenses d’internet", "Dépenses de gaz", "Dépenses d’électricité", "Dépenses d’eau", "Frais de télécommunications",

            // Variable
            "Frais de représentation", "Transport", "Entretien et réparations", "Charges locatives", "Location mobilière ou immobilière", 
            "Redevance de crédit-bail", "Fournitures administratives", "Publicité", "Assistance promir", "Honoraires d’expert-comptable et d’avocat", 
            "Frais de déplacements", "Cadeaux d’entreprise", "Autres",
            "Taxes et assimilés"
        ];

        return [
            // 'moyen_payement' => ['required', 'string','max:40', Rule::in($validPayments)],
            'montant' => 'numeric|required|max:9999999999|min:0.00000001',
            'type' => ['required', Rule::in($types)],
            'categorie' => ['required', Rule::in($categories)],
            'libelle' => ['required', Rule::in($libelles)],
            'periodicite' => 'string|required|max:60',
            'date_effet' => 'date|required',
        ];
    }

    private function messages(){
        return [
            'type.required' => 'Champ requis',
            'type.in' => 'Entrée invalide',
            'categorie.required' => 'Champ requis',
            'categorie.in' => 'Entrée invalide',
            'libelle.required' => 'Champ requis',
            'libelle.in' => 'Entrée invalide',
            'montant.max' => 'Max dépassé',
            'montant.min' => 'Trop petit',
            'montant.required' => 'Champ requis',
            'montant.numeric' => 'Nombre requis',
            'periodicite.max' => 'Max: :max lettres.',
            'periodicite.required' => 'Champ requis',
            'date_effet.date' => 'Date valide requise',
            'date_effet.required' => 'Champ requis',
        ];
    }


    public function store(Request $request){
        $validator = Validator::make($request->all(), $this->rules(),$this->messages());
        
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        if($request->libelle == "Vide"){
            return response()->json(["libelleVide" => "Le libellé est incorrecte!"]);
        }

        preg_match('/\d+/', $request->periodicite,$matches);
        $nombre_mois = (int) $matches[0] ?? 0;
        $date_echeance = Carbon::parse($request->date_effet)->addMonths($nombre_mois);
        

        Charges::create(
            [
                'categorie' => $request->categorie,
                'type' => $request->type,
                'libelle' => $request->libelle,
                'montant' => $request->montant,
                'date_effet' => $request->date_effet,
                'periodicite' => $request->periodicite,
                'date_echeance' => $date_echeance,
                'system_client_id' => MainClass::getSystemId(),
            ]
        );
        
        return response()->json(["message" => "Ajout éffectué avec succès."]);
    }

    public function edite(Request $request){
        $validator = Validator::make($request->all(), $this->rules(),$this->messages());
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $charge = Charges::findOrFail($request->id_charge);
        preg_match('/\d+/', $request->periodicite,$matches);
        $nombre_mois = (int) $matches[0] ?? 0;

        $date_echeance = Carbon::parse($request->date_effet)->addMonths($nombre_mois);
        $charge->montant = $request->montant;
        $charge->date_effet = $request->date_effet;
        $charge->date_echeance = $date_echeance;
        $charge->periodicite = $request->periodicite;

        if($charge->update()){
            return response()->json(["SUCCES!"=>true]);
        }
        return response()->json("Une erreur s'est produite.");
    }

    public function delete($id){
        try {
            $plan = Charges::findOrFail($id);
            $plan->delete();
            return redirect()->back()->with(toastr()->success('Charge supprimée!', 'OK'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with(toastr()->error('Charge non trouvée!', 'Erreur'));
        }
    }

}
