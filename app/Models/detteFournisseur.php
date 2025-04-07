<?php

namespace App\Models;


use App\Classes\CalculationsClass;
use App\Classes\MainClass;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class DetteFournisseur extends Model
{
    use HasFactory;

    protected $casts = [
        'date_effet' => 'datetime',
        'date_echeance' => 'datetime',
    ];

    protected $fillable = [
        'montant',
        'montant_paye',
        'date_echeance',
        'date_effet',
        'taux_de_penalite',
        'periodicite_de_penalite',
        'status',
        'manierePayement',
    ];


    public function modalitesEchellonnees(){
        return $this->hasMany(modaliteEchellonneeDetteFournisseur::class,'dette_fournisseur_id');
    }


    public function modalitePeriodique(){
        return $this->hasOne(modalitePeriodiqueDetteFournisseur::class,'dette_fournisseur_id');
    }


    public function approvisionnementSystemProduit(){
        return $this->hasOne(ApprovisionnementSystemProduit::class,'dette_fournisseur_id');
    }

    public function provision(){
        return $this->morphOne(Provision::class, 'engageable');
    }


    protected function getPortionJournaliereAttribute(){
        if($this->montant_paye < $this->montant && $this->status == "En cours"){

            if(!$this->date_effet || !$this->date_echeance){
                return 0.0;
            }
            return CalculationsClass::portionJournaliere(
                $this->montant,
                $this->date_effet->format('Y-m-d'), 
                $this->date_echeance->format('Y-m-d')
            );
        }

        return 0.0;
    }
    
    protected function getCumulAttribute(){
        if($this->montant_paye < $this->montant && $this->status == "En cours"){
            if(!$this->date_effet || !$this->date_echeance){
                return 0.0;
            }

            $maxDaysUtilDeadline = CalculationsClass::calculateWorkingDaysBetweenDates($this->date_effet, $this->date_echeance);
            $daysUntilToday = CalculationsClass::calculateWorkingDaysBetweenDates($this->date_effet, Carbon::today()->format('Y-m-d'));
            $daysUntilYesterday = min($maxDaysUtilDeadline, $daysUntilToday - 1);



            return CalculationsClass::portionJournaliere(
                $this->montant,
                $this->date_effet->format('Y-m-d'), 
                $this->date_echeance->format('Y-m-d')
            ) * $daysUntilYesterday;
        }

        return 0.0;
    }


    protected function getInteretPenaliteAttribute(){
        if(!$this->periodicite_de_penalite) return 0.0;

        if($this->montant_paye < $this->montant && $this->status == "En cours"){
            $depassement = CalculationsClass::calculerTailleDepassement($this->date_effet, $this->date_echeance, $this->periodicite_de_penalite);
            $penalite = 0;
            for($i = 0; $i < $depassement; $i++){
                $penalite += ($this->taux_de_penalite/100) * $this->montant;
            }
            return $penalite;
        }   
        return 0.0;
    }
}