<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'designation',
        'description',
        'prix_unitaire',
        'system_client_id'
    ];

    public function lignes_vente(){
        return $this->hasMany(LigneVente::class);
    }

    public function avances_client(){
        return $this->hasMany(AvanceClient::class);
    }

    public function system_client(){
        return $this->belongsTo(System_client::class);
    }


    public function prestations(){
        return $this->hasMany(PrestationService::class, 'service_id');
    }

}
