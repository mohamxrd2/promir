<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovisionnementSystemProduit extends Model
{
    use HasFactory;
    protected $table = 'approvisionnement_system_produits';
    protected $fillable = [
        'approvisionnement_id',
        'system_produit_id',
        'dette_fournisseur_id',
        'quantite_entree',
        'prix_unitaire_achat',
        'somme_reglee'
    ];


    public function detteFournisseur(){
        return $this->belongsTo(DetteFournisseur::class,'dette_fournisseur_id');
    }


    public function produitsBrut(){
        return $this->belongsTo(System_produit::class, 'system_produit_id');
    }



    public function approvisionnement(){
        return $this->belongsTo(Approvisionnement::class,'approvisionnement_id');
    }



    

}
