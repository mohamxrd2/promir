<?php

namespace App\Http\Controllers\dettes;

use App\Classes\MainClass;
use App\Http\Controllers\Controller;
use App\Models\Dette;
use App\Models\DettesClients;
use App\Models\LigneClientSysteme;
use App\Models\modaliteEchellonneeDetteClient;
use App\Models\modalitePeriodiqueDetteClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DettesClientsController extends Controller
{
    private function rules($typeModalite){

        $rules = [
            'date_echeance' => 'date|required',
            'date_effet' => 'date|required',
            'periodicite_de_penalite' => 'string|required',
            'taux_de_penalite' => 'numeric|required',
            'montantARegler.*' => 'numeric|required|max:9999999999',
            'dette_client_id' => 'integer|required|exists:dettes_clients,id',
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
            'dette_client_id.integer' => 'Un probleme est survenu',
            'dette_client_id.required' => 'Un probleme est survenu',
            'dette_client_id.exists' => 'Un probleme est survenu',
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
        $detteClients = DettesClients::whereHas('ligneVente.vente.lignClientSystem', function($query){
            $query->where('system_client_id', MainClass::getSystemId());
        })->with(['modalitesEchellonnees', 'modalitePeriodique', 'ligneVente.systemeProduit','ligneVente.produitTransforme','ligneVente.service', 'ligneVente.vente.lignClientSystem.client'])->orderBy('created_at', 'desc')->get();
        
        return view('dettes.dettes_clients', compact(['detteClients']));
    }

    public function storePlanRelement(Request $request){
        if($request->typeModalite != "Périodique" && $request->typeModalite != "Échelonnée"){ 
            return response()->json(["typeError" => true]);
        }

        $validator = Validator::make($request->all(), $this->rules($request->typeModalite), $this->messages($request->typeModalite));

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        
        $dette = DettesClients::find($request->dette_client_id);
        
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
                $modalite = modalitePeriodiqueDetteClient::create([
                    'dettes_client_id' => $dette->id,
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
                $modalite = modaliteEchellonneeDetteClient::create([
                    'dettes_client_id' => $dette->id,
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
        $validator = Validator::make($request->all(), $this->rules(''), $this->messages('') );
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
