<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banque extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'sigle',
        'mail',
        'adresse',
        'phone',
    ] ;


    public function dettesFinancieres(){
        return $this->hasMany(DetteFinanciere::class, 'banque_id');
    }
    
    public function compteBancaire(){
        return $this->hasMany(ComptesBancaires::class, 'banque_id');
    }
}
