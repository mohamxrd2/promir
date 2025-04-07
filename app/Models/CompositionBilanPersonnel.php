<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompositionBilanPersonnel extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'categorie',
        'libelle',
        'valeur',
        'bilan_personnel_id',
    ];

    public function blianPersonnel(){
        return $this->belongsTo(BilanPersonnel::class, 'bilan_personnel_id');
    }
}
