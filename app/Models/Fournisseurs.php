<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseurs extends Model
{
    use HasFactory;
        protected $fillable = [
            'nom',
            'type',
            'adresse',
            'email',
            'phone',
            'seconde_phone',
            'pays',
            'region',
            'departement',
            'localite',
        ];

    public function system_client_fornisseur(){
        return $this->hasMany(LigneFournisseursSysteme::class);
    }
}
