<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'nom',
        'adresse',
        'email',
        'phone',
        'seconde_phone',
        'region',
        'departement',
        'localite',
        'pays',
    ];

    public function ligne_system_client(){
        return $this->hasMany(LigneClientSysteme::class, 'client_id');
    }
}
