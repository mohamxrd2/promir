<?php

namespace App\Models;

use App\Classes\CalculationsClass;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetteFinanciere extends Model
{
    use HasFactory;
    protected $casts = [
        'date_effet' => 'datetime',
        'date_echeance' => 'datetime',
    ];
    protected $fillable = [
        'type_creancier',
        'nom_creancier',
        'mail_creancier',
        'phone_creancier',
        'adresse_creancier',
        'objet',
        'date_effet',
        'date_echeance',
        'montant_emprunte',
        'taux_interet',
        'montant_interet',
        'montant_paye',
        'status',
        'taux_de_penalite',
        'periodicite_de_penalite',
        'manierePayement',
        'system_client_id',
        'banque_id',
    ];


    public function provision(){
        return $this->morphOne(Provision::class, 'engageable');
    }

    protected function getCumulAttribute(){
        $dette = $this->montant_emprunte + $this->montant_interet;
        if($this->montant_paye < $dette && $this->status == "En cours"){
            if(!$this->date_effet || !$this->date_echeance){
                return 0.0;
            }

            $maxDaysUtilDeadline = CalculationsClass::calculateWorkingDaysBetweenDates($this->date_effet, $this->date_echeance);
            $daysUntilToday = CalculationsClass::calculateWorkingDaysBetweenDates($this->date_effet, Carbon::today()->format('Y-m-d'));
            $daysUntilYesterday = min($maxDaysUtilDeadline, $daysUntilToday - 1);

            return CalculationsClass::portionJournaliere(
                $dette,
                $this->date_effet->format('Y-m-d'), 
                $this->date_echeance->format('Y-m-d')
            ) * $daysUntilYesterday;
        }

        return 0.0;
    }

    protected function getPortionJournaliereAttribute(){
        $dette = $this->montant_emprunte + $this->montant_interet;
        if($this->montant_paye < $dette && $this->status == "En cours"){
            $date_effet = $this->date_effet->format('Y-m-d');
            $date_echeance = $this->date_echeance->format('Y-m-d');
            return CalculationsClass::portionJournaliere(
                $dette,
                $date_effet, 
                $date_echeance
            );
        }
        return 0.0;
    }


    public function systemClient(){
        return $this->belongsTo(System_client::class, 'system_client_id');
    }

    public function banque(){
        return $this->belongsTo(Banque::class, 'banque_id');
    }

    public function modalitesEchellonnees(){
        return $this->hasMany(modaliteEchellonneeDetteFinanciere::class,'dette_financiere_id');
    }
    
    public function modalitePeriodique(){
        return $this->hasOne(modalitePeriodiqueDetteFianciere::class,'dette_financiere_id');
    }
    
    public function payements(){
        return $this->hasMany(Payement::class,'dette_financiere_id');
    }



    protected function getInteretPenaliteAttribute(){
        if(!$this->periodicite_de_penalite) return 0.0;
        if($this->montant_paye < $this->montant_emprunte && $this->status == "En cours"){
            $depassement = CalculationsClass::calculerTailleDepassement($this->date_effet, $this->date_echeance, $this->periodicite_de_penalite);
            $penalite = 0;
            for($i = 0; $i < $depassement; $i++){
                $penalite += ($this->taux_de_penalite/100) * $this->montant;
            }
            return $penalite + $this->montant_interet;
        }   
        return 0.0;
    }
}
