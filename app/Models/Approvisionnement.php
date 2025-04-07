<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approvisionnement extends Model
{
    use HasFactory;
    protected $fillable = [
        'reference_payement',
        'moyen_payement',
        'description',
        'montant_paye',
        'ligne_fournisseurs_systeme_id',
    ];

    public function ligneFournisseur(){
        return $this->belongsTo(LigneFournisseursSysteme::class, 'ligne_fournisseurs_systeme_id');
    }
    public function pivotApprovisionnementProduit(){
        return $this->hasMany(ApprovisionnementSystemProduit::class,'approvisionnement_id');
    }
    
    public function produitsBruts(){
        return $this->belongsToMany(System_produit::class, 'approvisionnement_system_produits', 'approvisionnement_id', 'system_produit_id')->withPivot(['quantite_entree', 'prix_unitaire_achat', 'somme_reglee', 'dette_fournisseur_id']);
    }

    public function payement(){
        return $this->hasOne(Payement::class, 'approvisionnement_id');
    }

    public function getMontantAttribute(){
        return $this->produitsBruts->sum(function($produit){
            return $produit->pivot->quantite_entree * $produit->pivot->prix_unitaire_achat;
        });
    }
}
