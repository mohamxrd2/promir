<?php

namespace App\Http\Controllers;

use App\Classes\MainClass;
use App\Models\Investissements;
use App\Models\Reglement;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class InvestissementsController extends Controller
{
    public function index(){
        $investissements = Investissements::where('system_client_id', MainClass::getSystemId())->orderBy('montant')->get();
        return view('investissements.investissements', compact(['investissements']));
    }

    public function delete($id){
        try {
            $investissement = Investissements::findOrFail($id);
            $investissement->delete();
            return redirect()->back()->with(toastr()->success('Investissement supprimé avec succès!'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with(toastr()->error("Investissement non trouvé"));
        }
    }

    private function rules($r){
        $types = ["Immobilisation", "Circulant"];
        $categories = ["Immobilisations corporels", "Immobilisations incorporels", "Investissements financiers", "Disponiblité"];
        $libelles = [
            "Action en bourse", "Crypto monnaie", "Immobilier", "Métaux précieux",
            "Bâtiment", "Usine", "Machine", "Matériel", "Terrain",
            "Brevet", "Licence", "Fonds de commerce", "Autre materiel",
            "Trésorerie", "Placement", "Frais d'établissement", "Frais de recherche", "Matériel de bureau" , "Fond de commerce", "Avances et acompte", "Installations techniques"
        ];
        
        


        $rules = [
            'montant' => 'numeric|required|max:9999999999|min:0.00000001',
            'montant_reglement.*' => 'sometimes|required|numeric|max:9999999999|min:0.00000001',
            'mois.*' => 'sometimes|required|integer|max:12',
            'annee.*' => 'sometimes|required|string|max:4|min:4',
            'type' => ['required', Rule::in($types)],
            'categorie' => ['required', Rule::in($categories)],
            'libelle' => ['required', Rule::in($libelles)],
        ];

        if($r->type != "Circulant"){
            $rules['date_acquisition'] = 'sometimes|required|date';
            $rules['duree_de_vie'] = 'sometimes|integer|required|max:50|min:1';
        }

        return $rules;
    }

    private function messages(){
        return [
            'montant.max' => 'Trop grande',
            'montant.min' => 'Trop petite',
            'duree_de_vie.min' => 'Trop petite',
            'duree_de_vie.max' => 'Trop grande',
            'duree_de_vie.integer' => 'Entier requis',
            'date_acquisition.date' => 'Entrée invalide',
            'date_acquisition.required' => 'Champ requis',
            'montant.required' => 'Champ requis',
            'montant.numeric' => 'Nombre requis',
            'type.required' => 'Champ requis',
            'type.in' => 'Entrée invalide',
            'categorie.required' => 'Champ requis',
            'categorie.in' => 'Entrée invalide',
            'libelle.required' => 'Champ requis',
            'libelle.in' => 'Entrée invalide',

            'montant_reglement.*.required' => 'Champ requis',
            'montant_reglement.*.numeric' => 'Nombre requis',
            'montant_reglement.*.max' => 'Trop grand',
            'montant_reglement.*.min' => 'Trop petit',

            'annee.*.required' => 'Champ requis',
            'annee.*.max' => 'Trop grand',
            'annee.*.min' => 'Trop petit',

            'mois.*.required' => 'Champ requis',
            'mois.*.max' => 'Trop grand',
            'mois.*.min' => 'Trop petit',
        ];
    }


    public function store(Request $request){
        $validator = Validator::make($request->all(), $this->rules($request),$this->messages());
        
        

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        

        if(($request->libelle == 'Bâtiment' || $request->libelle == 'Usine'|| $request->libelle == 'Autre Construction') && ($request->duree_de_vie < 20 || $request->duree_de_vie > 50)){
            return response()->json(["erreurDuree" => "La durée doit être comprise entre 20 et 50 ans"]); 
        }elseif(($request->libelle == 'Machine' || $request->libelle == "Outillage") && ($request->duree_de_vie < 5 || $request->duree_de_vie > 10)){
            return response()->json(["erreurDuree" => "La durée doit être comprise entre 5 et 10 ans"]);
        }elseif($request->libelle == 'Micro-ordinateurs' && ($request->duree_de_vie != 3)){
            return response()->json(["erreurDuree" => "La durée autorisée est de 3 ans"]);
        }elseif( ($request->libelle == "Frais d'établissement" || $request->libelle == "Frais de recherche") && ($request->duree_de_vie != 5)){
            return response()->json(["erreurDuree" => "La durée autorisée est de 5 ans"]);
        }elseif($request->libelle == "Aménagement" && ($request->duree_de_vie < 10 || $request->duree_de_vie > 20)){
            return response()->json(["erreurDuree" => "La durée doit être comprise entre 10 et 20 ans"]);
        }elseif($request->libelle == "Matériel de transport" && ($request->duree_de_vie < 4 || $request->duree_de_vie > 5)){
            return response()->json(["erreurDuree" => "La durée doit être comprise entre 4 et 5 ans"]);
        }elseif(($request->libelle == "Matériel de bureau" || $request->libelle == "Autre materiel") && ($request->duree_de_vie < 5 || $request->duree_de_vie > 10)){
            return response()->json(["erreurDuree" => "La durée doit être comprise entre 5 et 10 ans"]);
        }elseif(($request->libelle == "Installations techniques") && ($request->duree_de_vie < 5 || $request->duree_de_vie > 20)){
            return response()->json(["erreurDuree" => "La durée doit être comprise entre 5 et 20 ans"]);
        }



        
        $date_peremption = Carbon::parse($request->date_acquisition)->addYears((int) $request->duree_de_vie);
        if($request->montant_paye > $request->montant) { return response()->json(['erreurMontantPaye' => 'Le montant payé est supérieur au montant réel!']);} 
        
        $status = $request->montant_paye == $request->montant ? "Reglé" : "En cours";

       $idInvestissement = Investissements::create(
            [
                'categorie' => $request->categorie,
                'type' => $request->type,
                'libelle' => $request->libelle,
                'montant' => $request->montant,
                'montant_paye' => $request->montant_paye,
                'date_acquisition' => $request->date_acquisition,
                'duree_de_vie' => $request->duree_de_vie,
                'date_peremption' => $date_peremption,
                'status' => $status,
                'system_client_id' => MainClass::getSystemId(),
            ]
        )->id;
        if($request->montant_reglement){
            foreach($request->montant_reglement as $index => $reglement){
                Reglement::create([
                    "annee" => $request->annee[$index],
                    "mois" => $request->mois[$index],
                    "montant" => $reglement,
                    "investissement_id" => $idInvestissement,
                ]);
            }
        }
        return response()->json(["message" => true]);
    }



















    public function edite(Request $request){
        $validator = Validator::make($request->all(), $this->rules($request),$this->messages());
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        if($request->montant_paye_modify > $request->montant) { return response()->json(['erreurMontantPaye' => 'Le montant payé est supérieur au montant réel!']);} 

        $charge = Investissements::findOrFail($request->id_investissement);
        
        $date_peremption = Carbon::parse($request->date_acquisition)->addYears((int) $request->duree_de_vie);
        $charge->montant = $request->montant;
        $charge->montant_paye = $request->montant_paye_modify;
        $charge->date_acquisition = $request->date_acquisition;
        $charge->duree_de_vie = $request->duree_de_vie;
        $charge->date_peremption = $date_peremption;

        if($request->montant > $request->montant_paye_modify){
            $charge->status = "En cours";
        }else{
            $charge->status = "Reglé";
        }

        if($charge->update()){
            return response()->json(["SUCCES!"=>true]);
        }
        return response()->json("Une erreur s'est produite.");
    }



    
}