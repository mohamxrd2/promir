<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payement extends Model
{
    use HasFactory;
    protected $fillable = [
        'montant',
        'reference',
        'fichier_joint',
        'moyen_payement',
        'dette_fournisseur_id',
        'dettes_client_id',
        'dette_financiere_id',
        'prestation_service_id',
        'approvisionnement_id',
        'avance_client_id',
        'investissement_id',
    ];


    public function detteFournisseur(){
        return $this->belongsTo(detteFournisseur::class, 'dette_fournisseur_id');
    }



    



    public function detteClient(){
        return $this->belongsTo(DettesClients::class, 'dettes_client_id');
    }
    
    public function detteFinanciere(){
        return $this->belongsTo(DetteFinanciere::class, 'dette_financiere_id');
    } 
    
    
    public function investissement(){
        return $this->belongsTo(Investissements::class, 'investissement_id');
    }
    

    public function prestation(){
        return $this->belongsTo(PrestationService::class, 'prestation_service_id');
    }

    public function approvisionnement(){
        return $this->belongsTo(Approvisionnement::class, 'approvisionnement_id');
    }
    
    public function avanceClient(){
        return $this->belongsTo(AvanceClient::class, 'avance_client_id');
    }
}
