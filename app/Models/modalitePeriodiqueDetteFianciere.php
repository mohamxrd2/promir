<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modalitePeriodiqueDetteFianciere extends Model
{
    use HasFactory;
    protected $fillable = [
        'dette_financiere_id',
        'montant',
        'status',
        'periodicite_payement',
        'nombre_depayement',
    ];

    public function dette(){
        return $this->belongsTo(DetteFinanciere::class,'dette_financiere_id');
    }
}
