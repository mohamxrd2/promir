<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionProduitbrut extends Model
{
    use HasFactory;
    protected $fillable = [
        'system_produit_id',
        'production_id',
        'quantite_utilisee',
    ];
}
