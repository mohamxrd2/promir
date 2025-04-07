<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\System_client;
use App\Models\Contrat_personnel;
class Personnel extends Model
{
    use HasFactory;
    protected $fillable = [
        'matricule',
        'nom',
        'prenom',
        'date_recrutement',
        'date_de_naissance',
        'lieu_de_naissance',
        'titre_poste',
        'num_cnps',
        'tel',
        'secteurIntervention',
        'Nationalite',
        'photo',
        'system_client_id',
    ];


    public function paies(){
        return $this->hasMany(PaieSalarier::class, 'personnel_id');
    }

    public function systeme_client(){
        return $this->belongsTo(System_client::class, 'system_client_id');
    }

    public function productions(){
        return $this->belongsToMany(Personnel::class, 'personnel_productions' ,'personnel_id', 'production_id');
    }

    public function contrat(){
        return $this->hasOne(Contrat_personnel::class, 'personnel_id');
    }

    public function prestations(){
        return $this->belongsToMany(PrestationService::class, 'personnel_prestation_services' ,'personnel_id', 'prestation_service_id');
    }


    public function getSalaireMensuelAttribute(){
        $salaire_mensuel = 0.0;
        if($this->contrat){
            if(is_numeric($this->contrat->salaire_mensuel)){
                $salaire_mensuel = $this->contrat->salaire_mensuel;
            }else{
                $salaire_mensuel = 0.0;
            }
        }
        return $salaire_mensuel;
    }
}
