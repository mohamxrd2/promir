<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat_personnel extends Model
{
    use HasFactory;
    protected $fillable = [
        'num_contrat',
        'date_debut',
        'categorie',
        'type_emploi',
        'salaire_mensuel',
        'nbr_jour_tr_pj',
        'nbr_h_tr_pj',
        'h_debut_tr',
        'nbr_h_pause_pj',
        'personnel_id',
    ] ;

    public function personnel(){
        return $this->belongsTo(Personnel::class, 'personnel_id');
    }
}


