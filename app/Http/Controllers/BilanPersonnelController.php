<?php

namespace App\Http\Controllers;

use App\Models\BilanPersonnel;
use App\Models\CompositionBilanPersonnel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class BilanPersonnelController extends Controller
{    
    public function index(){
        // $compositions = Auth::user()->blianPersonnel->compositions->groupBy('type')->map(function($groupesParType){
        //     return $groupesParType->groupBy('categorie');
        // }); 
        
        $blianPersonnel = Auth::user()->blianPersonnel;
        if($blianPersonnel){
            $compositions = $blianPersonnel->compositions;
        }else $compositions = []; 
        
        return view('bilan.bilan_personnel', compact('compositions'));
    }


    public function delete($id){
        $c = CompositionBilanPersonnel::findOrFail($id);
        $c->delete();
        return redirect()->back()->with(toastr()->success('Suppression éffctuée.'));
    }


    private function rules()
    {
        return [
            'autres_passif_a_long_terme' => 'nullable|numeric',
            'prets_etudiants' => 'nullable|numeric',
            'prets_hypothecaire_immeubles_locatifs' => 'nullable|numeric',
            'prets_hypothecaire_residence_secondaire' => 'nullable|numeric',
            'autres_passif_a_moyen_terme' => 'nullable|numeric',
            'prets_personnels' => 'nullable|numeric',
            'prets_automobiles' => 'nullable|numeric',
            'comptes_a_payer' => 'nullable|numeric',
            'marges_de_credit' => 'nullable|numeric',
            'cartes_de_credit' => 'nullable|numeric',
            'autres_biens_personnels' => 'nullable|numeric',
            'bijoux' => 'nullable|numeric',
            'oeuvres_art' => 'nullable|numeric',
            'terrains' => 'nullable|numeric',
            'immeubles_locatifs_a_revenus' => 'nullable|numeric',
            'residences_secondaires_chalet' => 'nullable|numeric',
            'encaisse' => 'nullable|numeric',
            'compte_d_epargne' => 'nullable|numeric',
            'obligations_epargne' => 'nullable|numeric',
            'epargne_terme_defini' => 'nullable|numeric',
            'autres_liquidites' => 'nullable|numeric',
            'epargne_terme_reguliere_dont_echeance_est_12_mois_plus' => 'nullable|numeric',
            'epargne_a_terme_indicielle' => 'nullable|numeric',
            'parts_permanentes_desjardins' => 'nullable|numeric',
            'Obligations_obligations_corporatives_coupons_detaches_debentures' => 'nullable|numeric',
            'fonds_de_placement' => 'nullable|numeric',
            'Valeur_rachat_d_assurances_vie' => 'nullable|numeric',
            'capital_regional_cooperatif_desjardins' => 'nullable|numeric',
            'fonds_des_travailleurs' => 'nullable|numeric',
            'regime_epargne_actions_REA' => 'nullable|numeric',
            'actions' => 'nullable|numeric',
            'autre_placements_non_enregistres' => 'nullable|numeric',
            'regime_enregistre_epargne_retraite_REER' => 'nullable|numeric',
            'compte_de_retraite_immobilise_CRI_ou_REER_immobilise' => 'nullable|numeric',
            'fonds_enregistre_de_revenu_de_retraite_FERR' => 'nullable|numeric',
            'fonds_de_revenu_viager_FRV' => 'nullable|numeric',
            'regime_enregistre_epargne_etudes_REEE' => 'nullable|numeric',
            'rente_viagere_ou_a_echeance_fixe' => 'nullable|numeric',
            'regime_de_pension_agree_caisse_de_retraite' => 'nullable|numeric',
            'regime_de_participation_differee_aux_benefices_RPDB' => 'nullable|numeric',
            'compte_pargne_libre_impot_CELI' => 'nullable|numeric',
            'autres_regimes_enregistres' => 'nullable|numeric',
            'meubles' => 'nullable|numeric',
            'vehicules_auto_bateau_moto_motoneige_roulotte_motorise' => 'nullable|numeric',
            'residence_principale' => 'nullable|numeric',
        ];
    }
    
    private function messages()
    {
        return [
            'autres_passif_a_long_terme.numeric' => 'Nombre requis',
            'prets_etudiants.numeric' => 'Nombre requis',
            'prets_hypothecaire_immeubles_locatifs.numeric' => 'Nombre requis',
            'prets_hypothecaire_residence_secondaire.numeric' => 'Nombre requis',
            'autres_passif_a_moyen_terme.numeric' => 'Nombre requis',
            'prets_personnels.numeric' => 'Nombre requis',
            'prets_automobiles.numeric' => 'Nombre requis',
            'comptes_a_payer.numeric' => 'Nombre requis',
            'marges_de_credit.numeric' => 'Nombre requis',
            'cartes_de_credit.numeric' => 'Nombre requis',
            'autres_biens_personnels.numeric' => 'Nombre requis',
            'bijoux.numeric' => 'Nombre requis',
            'oeuvres_art.numeric' => 'Nombre requis',
            'terrains.numeric' => 'Nombre requis',
            'immeubles_locatifs_a_revenus.numeric' => 'Nombre requis',
            'residences_secondaires_chalet.numeric' => 'Nombre requis',
            'encaisse.numeric' => 'Nombre requis',
            'compte_d_epargne.numeric' => 'Nombre requis',
            'obligations_epargne.numeric' => 'Nombre requis',
            'epargne_terme_defini.numeric' => 'Nombre requis',
            'autres_liquidites.numeric' => 'Nombre requis',
            'epargne_terme_reguliere_dont_echeance_est_12_mois_plus.numeric' => 'Nombre requis',
            'epargne_a_terme_indicielle.numeric' => 'Nombre requis',
            'parts_permanentes_desjardins.numeric' => 'Nombre requis',
            'Obligations_obligations_corporatives_coupons_detaches_debentures.numeric' => 'Nombre requis',
            'fonds_de_placement.numeric' => 'Nombre requis',
            'Valeur_rachat_d_assurances_vie.numeric' => 'Nombre requis',
            'capital_regional_cooperatif_desjardins.numeric' => 'Nombre requis',
            'fonds_des_travailleurs.numeric' => 'Nombre requis',
            'regime_epargne_actions_REA.numeric' => 'Nombre requis',
            'actions.numeric' => 'Nombre requis',
            'autre_placements_non_enregistres.numeric' => 'Nombre requis',
            'regime_enregistre_epargne_retraite_REER.numeric' => 'Nombre requis',
            'compte_de_retraite_immobilise_CRI_ou_REER_immobilise.numeric' => 'Nombre requis',
            'fonds_enregistre_de_revenu_de_retraite_FERR.numeric' => 'Nombre requis',
            'fonds_de_revenu_viager_FRV.numeric' => 'Nombre requis',
            'regime_enregistre_epargne_etudes_REEE.numeric' => 'Nombre requis',
            'rente_viagere_ou_a_echeance_fixe.numeric' => 'Nombre requis',
            'regime_de_pension_agree_caisse_de_retraite.numeric' => 'Nombre requis',
            'regime_de_participation_differee_aux_benefices_RPDB.numeric' => 'Nombre requis',
            'compte_pargne_libre_impot_CELI.numeric' => 'Nombre requis',
            'autres_regimes_enregistres.numeric' => 'Nombre requis',
            'meubles.numeric' => 'Nombre requis',
            'vehicules_auto_bateau_moto_motoneige_roulotte_motorise.numeric' => 'Nombre requis',
            'residence_principale.numeric' => 'Nombre requis',
        ];
    }    

    public function store(Request $request){
        
        $validator = Validator::make($request->all(), $this->rules(),$this->messages());
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    
       

        try{
            $blianPersonnel = Auth::user()->blianPersonnel;
        }catch(\Exception $e){
            $blianPersonnel = null;
        }


        if(!$blianPersonnel){


            
            $blianPersonnel = BilanPersonnel::create([
                'user_id' => Auth::user()->id,
            ]);

            CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Actif à court terme",
                'libelle' => "Actif à court terme Encaisse (soldes de vos comptes chèques)",
                'valeur' => $request->encaisse,
            ]);
            
            CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Actif à court terme",
                'libelle' => "Compte d’épargne",
                'valeur' => $request->compte_d_epargne,
            ]);
            
           
            CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Actif à court terme",
                'libelle' => "Obligations d’épargne (Obligation du Québec et du Canada)",
                'valeur' => $request->obligations_epargne,
            ]);
            
            CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Actif à court terme",
                'libelle' => "Épargne à terme (régulière ou rachetable dont l’échéance est de moins de 12 mois)",
                'valeur' => $request->epargne_terme_defini,
            ]);
            
            CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Actif à court terme",
                'libelle' => "Autres liquidités (Fonds de marché monétaire, bons du Trésor, etc.)",
                'valeur' => $request->autres_liquidites,
            ]);
            
            CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Placements non enregistrés",
                'libelle' => "Épargne à terme (régulière dont l’échéance est de 12 mois et plus)",
                'valeur' => $request->epargne_terme_reguliere_dont_echeance_est_12_mois_plus,
            ]);
            
            CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Placements non enregistrés",
                'libelle' => "Épargne à terme indicielle",
                'valeur' => $request->epargne_a_terme_indicielle,
            ]);
            
            CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Placements non enregistrés",
                'libelle' => "Parts permanentes Desjardins",
                'valeur' => $request->parts_permanentes_desjardins,
            ]);
            
            CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Placements non enregistrés",
                'libelle' => "Obligations (ex. : obligations corporatives, coupons détachés, débentures). Ne pas inclure les obligations d’épargne.",
                'valeur' => $request->Obligations_obligations_corporatives_coupons_detaches_debentures,
            ]);

            CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Placements non enregistrés",
                'libelle' => "Fonds de placement",
                'valeur' => $request->fonds_de_placement,
            ]);

            CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Placements non enregistrés",
                'libelle' => "Valeur de rachat d’assurances vie",
                'valeur' => $request->Valeur_rachat_d_assurances_vie,
            ]);
            
            
            CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Placements non enregistrés",
                'libelle' => "Capital régional et coopératif Desjardins",
                'valeur' => $request->capital_regional_cooperatif_desjardins,
            ]);
            
            CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Placements non enregistrés",
                'libelle' => "Fonds des travailleurs (FTQ, CSN, etc.)",
                'valeur' => $request->fonds_des_travailleurs,
            ]);
            
            CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Placements non enregistrés",
                'libelle' => "Régime d’épargne-actions (REA)",
                'valeur' => $request->regime_epargne_actions_REA,
            ]);
            
            
           
            
            CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Placements non enregistrés",
                'libelle' => "Actions",
                'valeur' => $request->actions,
            ]);CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Placements non enregistrés",
                'libelle' => "Autres placements non enregistrés",
                'valeur' => $request->autre_placements_non_enregistres,
            ]);CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Régimes enregistrés",
                'libelle' => "Régime enregistré d’épargne-retraite (REER)",
                'valeur' => $request->regime_enregistre_epargne_retraite_REER,
            ]);CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Régimes enregistrés",
                'libelle' => "Compte de retraite immobilisé (CRI) ou REER immobilisé",
                'valeur' => $request->compte_de_retraite_immobilise_CRI_ou_REER_immobilise,
            ]);CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Régimes enregistrés",
                'libelle' => "Fonds enregistré de revenu de retraite (FERR)",
                'valeur' => $request->fonds_enregistre_de_revenu_de_retraite_FERR,
            ]);CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Régimes enregistrés",
                'libelle' => "Fonds de revenu viager (FRV)",
                'valeur' => $request->fonds_de_revenu_viager_FRV,
            ]);CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Régimes enregistrés",
                'libelle' => "Régime enregistré d’épargne-études (REEE)",
                'valeur' => $request->regime_enregistre_epargne_etudes_REEE,
            ]);CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Régimes enregistrés",
                'libelle' => "Rente (viagère ou à échéance fixe)",
                'valeur' => $request->rente_viagere_ou_a_echeance_fixe,
            ]);CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Régimes enregistrés",
                'libelle' => "Régime de pension agréé (caisse de retraite)",
                'valeur' => $request->regime_de_pension_agree_caisse_de_retraite,
            ]);CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Régimes enregistrés",
                'libelle' => "Régime de participation différée aux bénéfices (RPDB)",
                'valeur' => $request->regime_de_participation_differee_aux_benefices_RPDB,
            ]);CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Régimes enregistrés",
                'libelle' => "Compte d’épargne libre d’impôt (CELI)",
                'valeur' => $request->compte_pargne_libre_impot_CELI,
            ]);CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Régimes enregistrés",
                'libelle' => "Autres Régimes enregistrés",
                'valeur' => $request->autres_regimes_enregistres,
            ]);CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Biens personnels",
                'libelle' => "Meubles",
                'valeur' => $request->meubles,
            ]);CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Biens personnels",
                'libelle' => "Véhicules (auto, bateau, moto, motoneige, roulotte, motorisé, etc.)",
                'valeur' => $request->vehicules_auto_bateau_moto_motoneige_roulotte_motorise,
            ]);CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Biens personnels",
                'libelle' => "Résidence principale",
                'valeur' => $request->residence_principale,
            ]);
            
            // ffffffffffffffffffffffffffffffff
            
            CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Biens personnels",
                'libelle' => "Résidences secondaires (chalet)",
                'valeur' => $request->residences_secondaires_chalet,
            ]);CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Biens personnels",
                'libelle' => "Immeubles locatifs (à revenus)",
                'valeur' => $request->immeubles_locatifs_a_revenus,
            ]);CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Biens personnels",
                'libelle' => "Terrains",
                'valeur' => $request->terrains,
            ]);

            CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Biens personnels",
                'libelle' => "Objets de collection",
                'valeur' => $request->objets_de_collection,
            ]);
            
            CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Biens personnels",
                'libelle' => "Oeuvres d’art",
                'valeur' => $request->oeuvres_art,
            ]);

            CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Biens personnels",
                'libelle' => "Bijoux",
                'valeur' => $request->bijoux,
            ]);CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Actif",
                'categorie' => "Biens personnels",
                'libelle' => "Autres biens personnels",
                'valeur' => $request->autres_biens_personnels,
            ]);CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Passifs",
                'categorie' => "Passif à court terme",
                'libelle' => "Cartes de crédit",
                'valeur' => $request->cartes_de_credit,
            ]);CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Passifs",
                'categorie' => "Passif à court terme",
                'libelle' => "Marges de crédit",
                'valeur' => $request->marges_de_credit,
            ]);CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Passifs",
                'categorie' => "Passif à court terme",
                'libelle' => "Comptes à payer",
                'valeur' => $request->comptes_a_payer,
            ]);CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Passifs",
                'categorie' => "Passif à moyen terme",
                'libelle' => "Prêts automobiles",
                'valeur' => $request->prets_automobiles,
            ]);CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Passifs",
                'categorie' => "Passif à moyen terme",
                'libelle' => "prêts personnels",
                'valeur' => $request->prets_automobiles,
            ]);CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Passifs",
                'categorie' => "Passif à moyen terme",
                'libelle' => "Autres passifs à moyen terme",
                'valeur' => $request->autres_passif_a_moyen_terme,
            ]);CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Passifs",
                'categorie' => "Passif à long terme",
                'libelle' => "Prêts hypothécaire (résidence secondaire)",
                'valeur' => $request->prets_hypothecaire_residence_secondaire,
            ]);CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Passifs",
                'categorie' => "Passif à long terme",
                'libelle' => "Prêts hypothécaire (immeubles locatifs)",
                'valeur' => $request->prets_hypothecaire_immeubles_locatifs,

            ]);CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Passifs",
                'categorie' => "Passif à long terme",
                'libelle' => "Prêts étudiants",
                'valeur' => $request->prets_etudiants,
            ]);

            CompositionBilanPersonnel::create([
                'bilan_personnel_id' => $blianPersonnel->id,
                'type' => "Passifs",
                'categorie' => "Passif à long terme",
                'libelle' => "Autres Passifs à long terme",
                'valeur' => $request->autres_passif_a_long_terme,
            ]);

            if($blianPersonnel->compositions->count() == 0){$blianPersonnel->delete;} 
        }
        
        if($blianPersonnel){

            $compositionsToUpdate = [
                'Autres Passifs à long terme' => $request->autres_passif_a_long_terme,
                'Oeuvres d’art' => $request->oeuvres_art,
                'Prêts étudiants' => $request->prets_etudiants,
                'Prêts hypothécaire (immeubles locatifs)' => $request->prets_hypothecaire_immeubles_locatifs,
                'Prêts hypothécaire (résidence secondaire)' => $request->prets_hypothecaire_residence_secondaire,
                'Autres passifs à moyen terme' => $request->autres_passif_a_moyen_terme,
                'Prêts personnels' => $request->prets_personnels,
                'Prêts automobiles' => $request->prets_automobiles,
                'Comptes à payer' => $request->comptes_a_payer,
                'Marges de crédit' => $request->marges_de_credit,
                'Cartes de crédit' => $request->cartes_de_credit,
                'Autres biens personnels' => $request->autres_biens_personnels,
                'Bijoux' => $request->bijoux,
                'Objets de collection' => $request->objets_de_collection,
                'Terrains' => $request->terrains,
                'Immeubles locatifs (à revenus)' => $request->immeubles_locatifs_a_revenus,
                'Résidences secondaires (chalet)' => $request->residences_secondaires_chalet,
                'Actif à court terme Encaisse (soldes de vos comptes chèques)' => $request->encaisse,
                'Compte d’épargne' => $request->compte_d_epargne,
                'Obligations d’épargne (Obligation du Québec et du Canada)' => $request->obligations_epargne,
                'Épargne à terme (régulière ou rachetable dont l’échéance est de moins de 12 mois)' => $request->epargne_terme_defini,
                'Autres liquidités (Fonds de marché monétaire, bons du Trésor, etc.)' => $request->autres_liquidites,
                'Épargne à terme (régulière dont l’échéance est de 12 mois et plus)' => $request->epargne_terme_reguliere_dont_echeance_est_12_mois_plus,
                'Épargne à terme indicielle' => $request->epargne_a_terme_indicielle,
                'Parts permanentes Desjardins' => $request->parts_permanentes_desjardins,
                'Obligations (ex. : obligations corporatives, coupons détachés, débentures)' => $request->Obligations_obligations_corporatives_coupons_detaches_debentures,
                'Fonds de placement' => $request->fonds_de_placement,
                'Valeur de rachat d’assurances vie' => $request->Valeur_rachat_d_assurances_vie,
                'Capital régional et coopératif Desjardins' => $request->capital_regional_cooperatif_desjardins,
                'Fonds des travailleurs (FTQ, CSN, etc.)' => $request->fonds_des_travailleurs,
                'Régime d’épargne-actions (REA)' => $request->regime_epargne_actions_REA,
                'Actions' => $request->actions,
                'Autres placements non enregistrés' => $request->autre_placements_non_enregistres,
                'Régime enregistré d’épargne-retraite (REER)' => $request->regime_enregistre_epargne_retraite_REER,
                'Compte de retraite immobilisé (CRI) ou REER immobilisé' => $request->compte_de_retraite_immobilise_CRI_ou_REER_immobilise,
                'Fonds enregistré de revenu de retraite (FERR)' => $request->fonds_enregistre_de_revenu_de_retraite_FERR,
                'Fonds de revenu viager (FRV)' => $request->fonds_de_revenu_viager_FRV,
                'Régime enregistré d’épargne-études (REEE)' => $request->regime_enregistre_epargne_etudes_REEE,
                'Rente (viagère ou à échéance fixe)' => $request->rente_viagere_ou_a_echeance_fixe,
                'Régime de pension agréé (caisse de retraite)' => $request->regime_de_pension_agree_caisse_de_retraite,
                'Régime de participation différée aux bénéfices (RPDB)' => $request->regime_de_participation_differee_aux_benefices_RPDB,
                'Compte d’épargne libre d’impôt (CELI)' => $request->compte_pargne_libre_impot_CELI,
                'Autres Régimes enregistrés' => $request->autres_regimes_enregistres,
                'Meubles' => $request->meubles,
                'Véhicules (auto, bateau, moto, motoneige, roulotte, motorisé, etc.)' => $request->vehicules_auto_bateau_moto_motoneige_roulotte_motorise,
                'Résidence principale' => $request->residence_principale,
            ];

            foreach ($compositionsToUpdate as $libelle => $valeur) {
                $composition = CompositionBilanPersonnel::where('libelle', $libelle)->first();
                if ($composition) {
                    if(is_numeric(value: $valeur)) $composition->update(['valeur' => $valeur]);
                }
            }
        }
        return response()->json(["message" => "Bilan enregistré avec succès."]);
    }
}