<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TresorerieMois extends Model
{
    protected $fillable = [
        'mois',
        'apports_en_capital',
        'apports_en_compte_courant',
        'emprunts',
        'ventes_marchandises',
        'remboursements_du_credit_tva',
        'marge_encaissements',
        'immobilsations_coprporelles',
        'echenaces_emprunts',
        'achats_marchandises_effectues',
        'consommables',
        'fournitures',
        'services_exterieurs',
        'impot_etat',
        'salaires_nets',
        'salaires_nets',
        'tva_a_payer',
        'solde_precedent',
        'charges_sociales',
        'marge_decaissements',
        'variation_tresorerie',
        'tresorerie_id',
    ];

   

    public function tresorie(){
        return $this->belongsTo(Tresorerie::class, "tresorerie_id");
    }
}

