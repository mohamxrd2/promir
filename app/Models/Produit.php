<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategorieProduit;
use App\Models\System_produit;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'designation',
        'format',
        'type',
        'calibrage',
        'conditionnement',
        'image',
        'categorie_produit_id',
    ];

    
    
    public function categorie(){
        return $this->belongsTo(CategorieProduit::class, 'categorie_produit_id');
    }

    public function systeme_produit(){
        return $this->hasMany(System_produit::class, 'produit_id');
    }
    public function productions()
    {
        return $this->belongsToMany(System_produit::class, 'production_produitbruts', 'system_produit_id', 'production_id',);
    }
}
