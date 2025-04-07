<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dette extends Model
{
    use HasFactory;
    protected $casts = [
        'date_effet' => 'datetime',
        'date_echeance' => 'datetime',
    ];
    protected $fillable = [
        'type',
        'montant',
        'montant_paye',
        'date_effet',
        'periode_de_penalite',
        'taux_de_penalite',
        'date_echeance',
        'objet',
        'status',
        'ligne_client_systeme_id',
        'banque_id',
        'ligne_fournisseurs_systeme_id',
        'system_client_id',
    ];


    public function systemClient(){
        return $this->belongsTo(System_client::class, 'system_client_id');
    }

    public function ligneClientSystem(){
        return $this->belongsTo(LigneClientSysteme::class, 'ligne_client_systeme_id');
    }

    public function banque(){
        return $this->belongsTo(Banque::class, 'banque_id');
    }

    public function ligneFournisseur(){
        return $this->belongsTo(LigneFournisseursSysteme::class, 'ligne_fournisseurs_systeme_id');
    }

}
