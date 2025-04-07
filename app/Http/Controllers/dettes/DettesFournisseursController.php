<?php

namespace App\Http\Controllers\dettes;

use App\Classes\MainClass;
use App\Http\Controllers\Controller;
use App\Models\ApprovisionnementSystemProduit;
use App\Models\Dette;
use App\Models\DetteFournisseur;
use App\Models\LigneFournisseursSysteme;
use App\Models\modaliteEchellonneeDetteFournisseur;
use App\Models\modalitePeriodiqueDetteFournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DettesFournisseursController extends Controller
{

    private function rules($typeModalite){

        $rules = [
            'date_echeance' => 'date|required',
            'date_effet' => 'date|required',
            'periodicite_de_penalite' => 'string|required',
            'taux_de_penalite' => 'numeric|required',
            'montantARegler.*' => 'numeric|required|max:9999999999',
            'dette_fournisseur_id' => 'integer|required|exists:dette_fournisseurs,id',
        ];

        if($typeModalite == "Périodique"){  
            $rules['periodicite_payement'] = 'string|required';
        }elseif($typeModalite == "Échelonnée"){
            $rules['date_reglement.*'] = 'date|required';
        }
        return $rules;
    }
    
    private function messages($typeModalite){
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
            'dette_fournisseur_id.integer' => 'Un probleme est survenu',
            'dette_fournisseur_id.required' => 'Un probleme est survenu',
            'dette_fournisseur_id.exists' => 'Un probleme est survenu',
        ];

        if($typeModalite == "Périodique"){  
            $messages['periodicite_payement.required'] = 'Champ requis';
        }elseif($typeModalite == "Échelonnée"){
            $messages['date_reglement.*.required'] = 'Champ requis';
            $messages['date_reglement.*.date'] = 'Date valide requise';
        }
        return $messages;
    }


    public function index(){

        $systemId = MainClass::getSystemId();
        $fournisseursPresents = LigneFournisseursSysteme::with('fournisseur')->where('system_client_id', $systemId)->orderBy('created_at')->get();
        $detteFournisseurs = DetteFournisseur::whereHas('approvisionnementSystemProduit.produitsBrut', function($query) use ($systemId){
            $query->where('system_client_id', $systemId);
        })->with(['modalitesEchellonnees', 'modalitePeriodique', 'approvisionnementSystemProduit.produitsBrut', 'approvisionnementSystemProduit.approvisionnement.ligneFournisseur.fournisseur'])->orderBy('created_at', 'desc')->get();
        return view('dettes.dettes_fournisseurs', compact(['detteFournisseurs', 'fournisseursPresents']));
    }

    public function storePlanRelement(Request $request){


        if($request->typeModalite != "Périodique" && $request->typeModalite != "Échelonnée"){
            return response()->json(["typeError" => true]);
        }

        $validator = Validator::make($request->all(), $this->rules($request->typeModalite), $this->messages($request->typeModalite));

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        
        $dette = DetteFournisseur::find($request->dette_fournisseur_id);
        
        $updatedDette = $dette->update([
            'date_echeance' => $request->date_echeance,
            'date_effet' => $request->date_effet,
            'taux_de_penalite' => $request->taux_de_penalite,
            'periodicite_de_penalite' => $request->periodicite_de_penalite,
        ]);

        if($request->typeModalite == "Périodique" && $updatedDette){
            if($dette->manierePayement == "Périodique"){
                $dette->modalitePeriodique()->first()->update([
                    'montant' => $request->montantARegler[0],
                    'periodicite_payement' => $request->periodicite_payement,
                ]);
            }else{
                $modalite = modalitePeriodiqueDetteFournisseur::create([
                    'dette_fournisseur_id' => $dette->id,
                    'montant' => $request->montantARegler[0],
                    'periodicite_payement' => $request->periodicite_payement,
                    ]);
    
                if($modalite){
                    $dette->update(['manierePayement' => 'Périodique']);
                }
            }
        }elseif($request->typeModalite == "Échelonnée" && $updatedDette){
            $updateDette = false;
            foreach ($request->date_reglement as $index => $date) {
                $modalite = modaliteEchellonneeDetteFournisseur::create([
                    'dette_fournisseur_id' => $dette->id,
                    'montant' => $request->montantARegler[$index],
                    'date_reglement' => $request->date_reglement[$index],
                    ]);

                if($modalite){
                    $updateDette = true;
                }
            }

            if($updateDette){
                $dette->update(['manierePayement' => 'Échelonnée']);
            }
            
        }


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
        $dette->periodicite_de_penalite = $request->periodicite_de_penalite;
        $dette->taux_de_penalite = $request->taux_de_penalite;
        $dette->montant = $request->montant;
        $dette->montant_paye = $request->montant_paye;
        $dette->status = $status;
        $dette->ligne_fournisseurs_systeme_id = $request->ligne_fournisseur;
        
        if($dette->update()){
            return response()->json(["SUCCES!"=>true]);
        }
        return response()->json("Une erreur s'est produite.");
    }
}