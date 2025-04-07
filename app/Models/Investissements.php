<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investissements extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'categorie',
        'libelle',
        'montant',
        'montant_paye',
        'date_acquisition',
        'date_peremption',
        'duree_de_vie',
        'status',
        'system_client_id',
    ];


    public function entreprise(){
        return $this->belongsTo(System_client::class, 'system_client_id');
    }

    public function payements(){
        return $this->hasMany(Payement::class,'investissement_id');
    }
    
    public function reglements(){
        return $this->hasMany(Reglement::class,'investissement_id');
    }


    public function getAmortissementQuotidienAttribute(){
        $debut = Carbon::parse($this->date_acquisition);
        $fin = Carbon::parse($this->date_acquisition);
        if($this->type == "Immobilisation"){
            $totalDays = $this->calculateTotalDays($this->date_acquisition, $this->duree_de_vie);
            return $totalDays > 0 ? ($this->valeur / $totalDays): 0;
        }else {
            return 0;
        }
    }

}

