<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProduitService extends Model
{
    use HasFactory;

    protected $fillable = [
        'ligne_vente_id',
        'system_produit_id',
        'quantite_produit',
    ];

    public function prestationService(){
        return $this->belongsTo(LigneVente::class, 'ligne_vente_id');
    } 
    
    public function produitUtilise(){
        return $this->belongsTo(System_produit::class, 'system_produit_id');
    }
}
