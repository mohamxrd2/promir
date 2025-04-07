<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvanceClient extends LigneVente
{
    use HasFactory;

    protected $table = "avance_clients";
    protected $fillable = [
        'estFinalisee',
        'estTotalementRegle',
        'ligne_vente_id',
    ];


    public function ligneVente(){
        return $this->belongsTo(LigneVente::class, foreignKey: "ligne_vente_id");
    }

    public function payement(){
        return $this->hasMany(Payement::class, 'avance_client_id');
    }

    public function getMontantAttribute(){
        if(!$this->ligneVente) return 0;
        return $this->ligneVente->montant_regle;
    }

}