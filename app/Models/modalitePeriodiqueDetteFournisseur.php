<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modalitePeriodiqueDetteFournisseur extends Model
{
    use HasFactory;
    protected $fillable = [
        'dette_fournisseur_id',
        'montant',
        'status',
        'periodicite_payement',
        'nombre_depayement',
    ];

    public function dette(){
        return $this->belongsTo(detteFournisseur::class,'dette_fournisseur_id');
    }
}
