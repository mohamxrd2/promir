<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modaliteEchellonneeDetteFinanciere extends Model
{
    use HasFactory;
    protected $fillable = [
        'dette_financiere_id',
        'montant',
        'status',
        'date_reglement',
    ];

    public function dette(){
        return $this->belongsTo(DetteFinanciere::class,'dette_financiere_id');
    }
}
