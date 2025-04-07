<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Produit;
class CategorieProduit extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
    ];

    public function produits(){
        return $this->hasMany(Produit::class , 'categorie_produit_id');
    }
}