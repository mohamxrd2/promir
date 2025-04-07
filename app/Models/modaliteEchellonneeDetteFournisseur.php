<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modaliteEchellonneeDetteFournisseur extends Model
{
    use HasFactory;
    protected $table = 'modalite_echellonnee_dette_fournisseurs';
    protected $fillable = [
        'dette_fournisseur_id',
        'montant',
        'status',
        'date_reglement',
    ];


    public function dette(){
        return $this->belongsTo(detteFournisseur::class,'dette_fournisseur_id');
    }
}