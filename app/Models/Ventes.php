<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventes extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'reference',
        'moyen_payement',
        'status_vente',
        'type_vente',
        'ligne_client_systeme_id',
    ];

    public function lignClientSystem(){
        return $this->belongsTo(LigneClientSysteme::class , 'ligne_client_systeme_id');
    }

    public function lignesVente(){
        return $this->hasMany(LigneVente::class, 'vente_id');
    }
    
    public function getMontantVenteAttribute(){
        return $this->lignesVente->sum(function($lv){
            return $lv->quantite_vendue * $lv->prix_vente;
        });
    }
    
    public function getMontantRegleAttribute(){
        return $this->lignesVente->sum('montant_regle');
    }
}
