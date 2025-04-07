<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LigneFournisseursSysteme extends Model
{
    use HasFactory;

    protected $fillable = [
        'est_potentiel',
        'system_client_id',
        'fournisseur_id',
    ];

    public function system_client(){
        return $this->belongsTo(System_client::class, 'system_client_id');
    }

    public function fournisseur(){
        return $this->belongsTo(Fournisseurs::class, 'fournisseur_id');
    }
    
    public function dettes(){
        return $this->hasMany(Dette::class, 'ligne_fournisseurs_systeme_id');
    }
}
