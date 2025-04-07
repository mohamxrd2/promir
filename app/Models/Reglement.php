<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reglement extends Model
{

    protected $fillable = [
        'montant',
        'annee',
        'mois',
        'investissement_id',
    ];
    
    public function investissement(){
        return $this->belongsTo(Investissements::class,'investissement_id');
    }

    
}
