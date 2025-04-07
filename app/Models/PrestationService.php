<?php

namespace App\Models;

use App\Classes\MainClass;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestationService extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'ligne_client_systeme_id',
        'montant_facture',
    ];
    public function service(){
        return $this->belongsTo(Services::class, 'service_id');
    }
    public function client(){
        return $this->belongsTo(LigneClientSysteme::class, 'ligne_client_systeme_id');
    }
    
    public function produits(){
        return $this->belongsToMany(System_produit::class, 'prestation_service_system_produits' ,'prestation_service_id', 'system_produit_id')->withPivot('quantite');
    }
    public function personnel(){
        return $this->belongsToMany(Personnel::class, 'personnel_prestation_services' ,'prestation_service_id', 'personnel_id')->withPivot('heures');
    }

    public function payement(){
        return $this->hasOne(Payement::class, 'prestation_service_id');
    }
    
    public function dette(){
        return $this->hasOne(DettesClients::class, 'prestation_service_id');
    }


    public function getCoutProduitsAttribute(){
        $cout_produit = $this->produits->sum(function($produit){
            return $produit->pivot->quantite * $produit->pua;
        });
        return $cout_produit;
    }
    
    public function getCoutPersonnelAttribute(){
        $cout_personnel = $this->personnel->sum(function($agent) {
            $contrat = $agent->contrat;
            $nbrJours = $contrat->nbr_jour_tr_pj > 0 
                ? $contrat->nbr_jour_tr_pj 
                : MainClass::getNumberOfWorkingDaysInThisMonth();
            if ($contrat->salaire_mensuel && $contrat->nbr_h_tr_pj > 0 && $nbrJours > 0) {
                $coutHoraire = $contrat->salaire_mensuel / ($contrat->nbr_h_tr_pj * $nbrJours);
                return $agent->pivot->heures * $coutHoraire;
            }
            return 0;
        });
        return $cout_personnel;
    }
    
    
    public function getMontantRegleAttribute(){
        if($this->has('payement')){
            return $this->payement->montant;
        }
        return 0;
    }
}

