<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portionnement extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'nombre',
        'system_produit_id',
    ];

    public function systemProduit(){
        return $this->belongsTo(System_produit::class);
    }
}
