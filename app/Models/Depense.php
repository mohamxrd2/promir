<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    use HasFactory;
    protected $fillable = [
        'type_depense_id',
        'libelle',
        'montant',
        'montant_regle',

        // montant_regle_sur_place sert dans les calculs du montant à deduire du revenu journalier avant de passer aux provisions

        'montant_regle_sur_place',
        'moyen_payement',
        'reference_payement',
        'beneficiaire',
        'system_client_id',
    ];


    public function system_client(){
        return $this->belongsTo(System_client::class, 'system_client_id');
    }

    public function typeDepense(){
        return $this->belongsTo(typesDepense::class, 'type_depense_id');
    }

}
