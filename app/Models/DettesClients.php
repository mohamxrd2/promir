<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DettesClients extends Model
{
    use HasFactory;
    protected $casts = [
        'date_effet' => 'datetime',
        'date_echeance' => 'datetime',
    ];

    protected $table = "dettes_clients";
    protected $fillable = [
        'montant',
        'montant_paye',
        'date_echeance',
        'date_effet',
        'taux_de_penalite',
        'periodicite_de_penalite',
        'status',
        'ligne_vente_id',
        'prestation_service_id',
        'manierePayement',
    ];

    public function ligneVente(){
        return $this->belongsTo(LigneVente::class, 'ligne_vente_id');
    }
    
    public function prestation(){
        return $this->belongsTo(PrestationService::class, 'prestation_service_id');
    }

    public function modalitesEchellonnees(){
        return $this->hasMany(modaliteEchellonneeDetteClient::class,'dettes_client_id');
    }
    
    public function payements(){
        return $this->hasMany(Payement::class,'dettes_client_id');
    }

    public function modalitePeriodique(){
        return $this->hasOne(modalitePeriodiqueDetteClient::class,'dettes_client_id');
    }
}

