<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livraisons extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantite_livree',
        'annulee',
        'geree',
        'system_produit_id',
        'produit_transforme_id',
        'ligne_client_systeme_id',
    ];


    public function ligneClientSysteme(){
        return $this->BelongsTo(LigneClientSysteme::class, 'ligne_client_systeme_id');
    }

    public function systemProduit(){
        return $this->BelongsTo(System_produit::class, 'system_produit_id');
    }

    public function produitTransforme(){
        return $this->BelongsTo(ProduitTransforme::class, 'produit_transforme_id');
    }
}
