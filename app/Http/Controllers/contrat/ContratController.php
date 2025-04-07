<?php

namespace App\Http\Controllers\contrat;
use App\Classes\MainClass;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contrat_personnel;
use App\Models\Personnel;

class ContratController extends Controller
{

    public function index(){
        $people = Personnel::where("system_client_id", MainClass::getSystemId())->whereHas('contrat')->with('contrat')->orderBy('created_at', 'desc')->get();
        $people_sans_contrat = Personnel::where("system_client_id", MainClass::getSystemId())->whereDoesntHave('contrat')->orderBy('created_at', 'desc')->get();
        return view("personnel.contrat_personnel", compact(["people", "people_sans_contrat"]));
    }

    public function display_personnel_for_contrat($id){
        $concerne = Personnel::findOrFail($id);
        return response()->json($concerne);
    }

    public function delete($id){
        $contrat = Contrat_personnel::findOrFail($id);
        $contrat->delete();
        
        return redirect()->back()->with(toastr()->success('Suppression éffctuée.', 'OK'));
    }
    
    

    public function store(Request $request){
        
        
        
        $validator = Validator::make($request->all(), [
            'num_contrat' => 'required|string|max:60|unique:contrat_personnels',
            'date_debut' => 'required|date',
            'categorie' => 'required|string|max:60',
            'type_emploi' => 'required|string|max:20',
            'salaire_mensuel' => 'required|numeric',
            'nbr_jour_tr_pj' => 'required|integer',
            'nbr_h_tr_pj' => 'required|integer',
            'h_debut_tr' => 'required',
            'nbr_h_pause_pj' => 'required|numeric|max:10',
            'personnel_id' => 'required|exists:personnels,id',
        ],
        [
            'num_contrat.required' => 'Le numéro de contrat est requis.',
            'num_contrat.max' => 'Le numéro de contrat ne doit pas dépasser :max caractères.',
            'num_contrat.unique' => 'Ce numéro de contrat est déjà utilisé.',
            'date_debut.required' => 'La date de début est requise.',
            'date_debut.date' => 'La date de débutdoit etre une date.',
            'categorie.required' => 'La catégorie est requise.',
            'categorie.max' => 'La catégorie ne doit pas dépasser :max caractères.',
            'type_emploi.required' => 'Le type d\'emploi est requis.',
            'type_emploi.max' => 'Le type d\'emploi ne doit pas dépasser :max caractères.',
            'salaire_mensuel.required' => 'Le salaire mensuel est requis.',
            'salaire_mensuel.numeric' => 'Le salaire mensuel doit être un nombre.',
            'nbr_jour_tr_pj.required' => 'Le nombre de jours travaillés par mois est requis.',
            'nbr_jour_tr_pj.integer' => 'Le nombre de jours travaillés par mois doit être un entier.',
            'nbr_h_tr_pj.required' => 'Le nombre d\'heures travaillées par jour est requis.',
            'nbr_h_tr_pj.integer' => 'Le nombre d\'heures travaillées par jour doit être un entier.',
            'h_debut_tr.required' => 'L\'heure de début de travail est requise.',
            'nbr_h_pause_pj.required' => 'Le nombre d\'heures de pause par jour est requis.',
            'nbr_h_pause_pj.numeric' => 'Le nombre d\'heures de pause par jour doit être un nombre.',
            'nbr_h_pause_pj.max' => 'Le nombre d\'heures de pause par jour ne doit pas dépasser :max.',
            'personnel_id.required' => 'L\'identifiant du personnel est requis.',
            'personnel_id.exists' => 'Le personnel sélectionné n\'existe pas.',
        ]);
        
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        
        
        Contrat_personnel::create($request->all());
        
        return response()->json(["message" => "Contrat defini avec succès!"]);
    }



    public function edite(Request $request){

        $validator = Validator::make($request->all(), [
            'num_contratm' => 'required|string|max:60|unique:contrat_personnels,num_contrat,' . $request->id_contratm,
            'date_debutm' => 'required|date',
            'id_contratm' => 'required|exists:contrat_personnels,id',
            'categoriem' => 'required|string|max:60',
            'type_emploim' => 'required|string|max:20',
            'salaire_mensuelm' => 'required|numeric',
            'nbr_jour_tr_pjm' => 'required|integer',
            'nbr_h_tr_pjm' => 'required|integer',
            'h_debut_trm' => 'required',
            'nbr_h_pause_pjm' => 'required|integer|max:10',
        ],
         [
            'num_contratm.required' => 'Le numéro de contrat est requis.',
            'num_contratm.max' => 'Le numéro de contrat ne doit pas dépasser :max caractères.',
            'num_contratm.unique' => 'Ce numéro de contrat est déjà utilisé.',
            'date_debutm.required' => 'La date de début est requise.',
            'date_debutm.date' => 'La date de débutdoit etre une date.',
            'categoriem.required' => 'La catégorie est requise.',
            'categoriem.max' => 'La catégorie ne doit pas dépasser :max caractères.',
            'type_emploim.required' => 'Le type d\'emploi est requis.',
            'type_emploim.max' => 'Le type d\'emploi ne doit pas dépasser :max caractères.',
            'salaire_mensuelm.required' => 'Le salaire mensuel est requis.',
            'salaire_mensuelm.numeric' => 'Le salaire mensuel doit être un nombre.',
            'nbr_jour_tr_pjm.required' => 'Le nombre de jours travaillés par mois est requis.',
            'nbr_jour_tr_pjm.integer' => 'Le nombre de jours travaillés par mois doit être un entier.',
            'nbr_h_tr_pjm.required' => 'Le nombre d\'heures travaillées par jour est requis.',
            'nbr_h_tr_pjm.integer' => 'Le nombre d\'heures travaillées par jour doit être un entier.',
            'h_debut_trm.required' => 'L\'heure de début de travail est requise.',
            'nbr_h_pause_pjm.required' => 'Le nombre d\'heures de pause par jour est requis.',
            'nbr_h_pause_pjm.integer' => 'Le nombre d\'heures de pause par jour doit être un entier.',
            'nbr_h_pause_pjm.max' => 'Le nombre d\'heures de pause par jour ne doit pas dépasser :max.',
        ]);
        

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $contrat = Contrat_personnel::findOrFail($request->id_contratm);
        $contrat->num_contrat = $request->num_contratm;
        $contrat->date_debut = $request->date_debutm;
        $contrat->categorie = $request->categoriem;
        $contrat->type_emploi = $request->type_emploim;
        $contrat->salaire_mensuel = $request->salaire_mensuelm;
        $contrat->nbr_jour_tr_pj = $request->nbr_jour_tr_pjm;
        $contrat->nbr_h_tr_pj = $request->nbr_h_tr_pjm;
        $contrat->h_debut_tr = $request->h_debut_trm;
        $contrat->nbr_h_pause_pj = $request->nbr_h_pause_pjm;
        if($contrat->update()){
            return response()->json(["SUCCES!"=>true]);
        }
        return response()->json("ERREUR!");
    }
}

