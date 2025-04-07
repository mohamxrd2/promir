<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProduitTransforme extends Model
{
    use HasFactory;
    protected $fillable = [
        'reference',
        'designation',
        'portion_unitaire',
        'prix_unitaire_portion',
        'qte_en_portions',
    ];

    public function productions(){
        return $this->hasMany(Production::class, 'produit_transforme_id');
    }

    public function livraisons(){
        return $this->hasMany(Livraisons::class, 'produit_transforme_id');
    }

    public function lignesVente(){
        return $this->hasMany(LigneVente::class, 'produit_transforme_id');
    }

    public function avancesClient(){
        return $this->hasMany(AvanceClient::class, 'produit_transforme_id');
    }

    public function inventaires(){
        return $this->morphMany(Inventaire::class, 'produitable');
    }
}
