<?php

namespace App\Http\Controllers\payement;

use App\Classes\MainClass;
use App\Http\Controllers\Controller;
use App\Models\AvanceClient;
use App\Models\Dette;
use App\Models\DetteFinanciere;
use App\Models\detteFournisseur;
use App\Models\DettesClients;
use App\Models\Investissements;
use App\Models\LigneVente;
use App\Models\modaliteEchellonneeDetteClient;
use App\Models\modaliteEchellonneeDetteFournisseur;
use App\Models\modalitePeriodiqueDetteClient;
use App\Models\modalitePeriodiqueDetteFournisseur;
use App\Models\Payement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Route;

class Payementsontroller extends Controller
{

    private function rules(){
        return [
            'montantARegler' => 'required|numeric|max:9999999999|min:0.00001',
            'reference' => 'nullable|string|max:255|unique:payements,reference,NULL,reference',
            'fichier_joint' => 'file|mimes:pdf,png,jpeg,jpg|max:2048', // 2MB Max
        ];
    }
    
    private function messages(){
        return [
            'montantARegler.required' => 'Montant requis',
            'montantARegler.max' => 'Somme trop grande',
            'montantARegler.min' => 'Somme trop petite',
            'montantARegler.numeric' => 'Nombre requis',
            'reference.max' => 'Max de :max caractères requis',
            'reference.unique' => 'Déjà utilisée',
            'fichier_joint.file' => 'Fichier invalide',
            'fichier_joint.mimes' => 'Types valides: :values',
            'fichier_joint.max' => '2MB Max',
        ];
    }
    
    public function addPayementDette(Request $request) {
        $validator = Validator::make($request->all(), $this->rules(), $this->messages());
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        if(!($request->filled('reference')) && !($request->hasFile('fichier_joint'))){
            return response()->json(["problemeDeTraçabilite" => true]);
        }

        if($request->somme){
            $montant = $request->somme;
        }else if($request->montantARegler){
            $montant = $request->montantARegler;
        }else{
            return response()->json(["autreProbleme" => true]);
        }

        
        if($request->route()->getName() =='payementDetteClient.edite'){
            $payement = Payement::create([
                'montant'=> $montant,
                'dettes_client_id'=> $request->idDette,
            ]);
            $dette = DettesClients::findOrFail($request->idDette);
        } elseif($request->route()->getName() =='payementDetteFinanciere.edite'){
            $payement = Payement::create([
                'montant'=> $montant,
                'dette_financiere_id'=> $request->idDette,
            ]);
            $dette = DetteFinanciere::findOrFail($request->idDette);
        } elseif($request->route()->getName() =='payementDetteFournisseur.edite'){
            $payement = Payement::create([
                'montant'=> $montant,
                'dette_fournisseur_id'=> $request->idDette,
            ]);
            $dette = detteFournisseur::findOrFail($request->idDette);
        } elseif($request->route()->getName() =='payementDetteSurAvanceProduit.edite'){
            $payement = Payement::create([
                'montant'=> $montant,
                'avance_client_id'=> $request->idDette,
            ]);
            $dette = AvanceClient::findOrFail($request->idDette);
        } elseif($request->route()->getName() =='payementDetteSurInvestissement.edite'){
            $payement = Payement::create([
                'montant'=> $montant,
                'investissement_id'=> $request->idDette,
            ]);
            $dette = Investissements::findOrFail($request->idDette);
        }


        if($payement){
            if($request->route()->getName() =='payementDetteSurAvanceProduit.edite'){

                // Ici, la dette concerne la ligne vente et c'est bien l'identifiant de la ligne vente qui est dans idVente de la variable request
                // Donc on vas chercher dans les ligne ventes.

                $dette = LigneVente::findOrFail($request->idDette);
                $m_ = $dette->montant_regle;
                $p = $dette->prix_vente;
                $q = $dette->quantite_vendue;
                if($m_ < $p * $q){
                    if(($m_ + $montant) <= $p * $q){
                        $dette->montant_regle += $montant;
                        $dette->update();
                        MainClass::gererPreuvesPayement($request, $payement);
                        return response()->json(["ok" => true]);
                    }else{
                        $payement->delete();
                        return response()->json(["depassementDeMontant" => true]);
                    }
                }else{
                    $payement->delete();
                    return response()->json(["rienARegler" => true]);
                }
            }









            
            $montant_paye = $dette->montant_paye + $montant;
            $status = $dette->montant - $montant_paye == 0 ? 'Reglé' : 'En cours';
            
            
            if($request->route()->getName() =='payementDetteFinanciere.edite'){
                if($montant_paye > $dette->montant_emprunte + $dette->montant_interet){
                    $payement->delete();
                    return response()->json(["depassementDeMontant" => true]);
                }
            }else{
                if($montant_paye > $dette->montant){
                    $payement->delete();
                    return response()->json(["depassementDeMontant" => true]);
                }
            }
            $dette->update([
                'montant_paye' => $montant_paye,
                'status' => $status,
            ]);
        }
        
        MainClass::gererPreuvesPayement($request, $payement);

        if ($request->typeModalite == "Périodique"){
            if (Route::currentRouteName() == "payementDetteClient.edite"){
                $modalite = modalitePeriodiqueDetteClient::find($request->iModalite);
                $modalite->nombre_depayement++;
                if ($modalite->dette->montant == $modalite->dette->montant_paye){
                    $modalite->status = "Règlé";
                }
                $modalite->update();
            }else if(Route::currentRouteName() == "payementDetteFournisseur.edite"){
                $modalite = modalitePeriodiqueDetteFournisseur::find($request->iModalite);
                $modalite->nombre_depayement++;
                if($modalite->dette->montant == $modalite->dette->montant_paye){
                    $modalite->status = "Règlé";
                }
                $modalite->update();
            }
        }else if($request->typeModalite == "Échelonnée"){
            if(Route::currentRouteName() == "payementDetteClient.edite"){
                $modalite = modaliteEchellonneeDetteClient::find($request->iModalite);
                $modalite->status = "Règlé";
                $modalite->update();
            }else if(Route::currentRouteName() == "payementDetteFournisseur.edite"){
                $modalite = modaliteEchellonneeDetteFournisseur::find($request->iModalite);
                $modalite->status = "Règlé";
                $modalite->update();
            }
        }
       return response()->json(["ok" => true]);
    }
}
