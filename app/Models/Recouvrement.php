<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recouvrement extends Model
{
    use HasFactory;
    protected $fillable = [
        'somme',
        'reference',
        'fichier_joint',
        'impaye_vente_id',
    ];

    public function impayeVente(){
        return $this->belongsTo(ImpayeVente::class, 'impaye_vente_id');
    }
}
