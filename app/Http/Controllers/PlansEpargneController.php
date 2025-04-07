<?php

namespace App\Http\Controllers;

use App\Models\PlansEpargne;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PlansEpargneController extends Controller
{


    private function rulesAndMessages(){
        $rulesAndMessages['periode'] = [
            "Jour", "Semaine", "Mois", "Trimestre", "Semestre", "Année",
        ];

        $rulesAndMessages['rules'] =  [
            'libelle' => 'required|string|max:60',
            'montant' => 'numeric|required',
            'periodicite' => ['string', 'required', Rule::in($rulesAndMessages['periode'])],
        ];

        $rulesAndMessages['messages'] = [
            'libelle.required' => 'Un libéllé est requisé',
            'libelle.max' => 'Le libéllé ne doit pas dépasser :max caractères',
            'montant.required' => 'Le montant est requis',
            'montant.numeric' => 'Le montant doit être un nombre',
            'periodicite.in' => 'La périodicité est invalide',
        ];

        return $rulesAndMessages;
    }

    public function index()
    {
        $user = Auth::user();
    
        if (!$user || !$user->system_client) {
            abort(403, 'Accès non autorisé'); // Empêche l'accès si aucun system_client n'est trouvé
        }
    
        $plans_epargne = PlansEpargne::where('system_client_id', $user->system_client->id)
            ->orderBy('montant')
            ->get();
    
        return view('epargnes.epargne', compact('plans_epargne'));
    }
    

    public function store(Request $request){
        $validator = Validator::make($request->all(), $this->rulesAndMessages()['rules'], $this->rulesAndMessages()['messages']);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
       
        PlansEpargne::create(
            [
              'libelle' => $request->libelle,
              'montant' => $request->montant,
              'periodicite' => $request->periodicite ?? null,
              'system_client_id' => Auth::user()->system_client->id,
            ]
        );

        return response()->json(["message" => "Epargne definie avec succès!"]);
    }


    public function edite(Request $request){
        $validator = Validator::make($request->all(), $this->rulesAndMessages()['rules'], $this->rulesAndMessages()['messages']);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $plan = PlansEpargne::findOrFail($request->id_plan);
        $plan->libelle = $request->libelle;
        $plan->montant = $request->montant;
        $plan->periodicite = $request->periodicite;
        if($plan->update()){
            return response()->json(["SUCCES!"=>true]);
        }
        return response()->json("une erreur s'est produite.");
    }


    public function delete($id){
        try {
            $plan = PlansEpargne::findOrFail($id);
            $plan->delete();
            return redirect()->back()->with(toastr()->success('Epargne supprimée!', 'OK'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with(toastr()->error('Epargne non trouvée!', 'Erreur'));
        }
    }
}
