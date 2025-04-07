<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class LigneClientSysteme extends Model
{
    use HasFactory;
    protected $fillable = [
        'system_client_id',
        'client_id',
    ];

    public function systemClient(){
        return $this->belongsTo(System_client::class, 'system_client_id');
    }

    public function client(){
        return $this->belongsTo(Clients::class, 'client_id');
    }


    public function ventes(){
        return $this->hasMany(Ventes::class, 'ligne_client_systeme_id');
    }

    public function prestations(){
        return $this->hasMany(PrestationService::class, 'ligne_client_systeme_id');
    }
    
    public function livraisons(){
        return $this->hasMany(Livraisons::class, 'ligne_client_systeme_id');
    }

    public function dettes(){
        return $this->hasMany(Dette::class, 'ligne_client_systeme_id');
    }

}
