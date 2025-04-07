<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaieSalarier extends Model
{
    protected $fillable = [
        'salaire_base',
        'autres_avantages',
        'periode_paie',
        'nombre_de_parts',
        'prime_transport',
        'anciennete',
        'salaireBrutImposable',
        'cmu',
        'sursalaire',
        'retenu_ITS',
        'situation_matrimoniale',
        'nombre_enfants',
        'personnel_id',
    ];

    public function personnel(){
        return $this->belongsTo(Personnel::class, 'personnel_id');
    }
}