<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpayeVente extends Model
{
    use HasFactory;
    protected $fillable = [
        'somme',
        'status',
        'ligne_vente_id',
    ];

    
    public function recouvrements(){
        return $this->hasMany(Recouvrement::class, 'impaye_vente_id');
    }

    
    public function ligneVente(){
        return $this->belongsTo(LigneVente::class, 'ligne_vente_id');
    }
}