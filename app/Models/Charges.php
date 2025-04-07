<?php

namespace App\Models;

use App\Classes\CalculationsClass;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charges extends Model
{
    use HasFactory;

    protected $casts = ['date_effet' => 'datetime', 'date_echeance' => 'datetime'];
    protected $fillable = [
        'categorie',
        'type',
        'libelle',
        'montant',
        'date_effet',
        'date_echeance',
        'periodicite',
        'system_client_id',
    ] ;

    public function systemClient(){
        return $this->belongsTo(System_client::class);
    }

    public function provision(){
        return $this->morphOne(Provision::class, 'engageable');
    }


    protected function getCumulAttribute(){
        // if($this->montant_paye < $this->montant && $this->status == "En cours"){
            if(!$this->date_effet || !$this->date_echeance){
                return 0.0;
            }

            $daysUntilToday = CalculationsClass::calculateWorkingDaysBetweenDates($this->date_effet, Carbon::today()->format('Y-m-d'));

            $daysUntilYesterday = $daysUntilToday - 1;

            return CalculationsClass::portionJournaliere(
                $this->montant,
                $this->date_effet->format('Y-m-d'), 
                $this->date_echeance->format('Y-m-d')
            ) * $daysUntilYesterday;
        // }

        // return 0.0;
    }


    protected function getPortionJournaliereAttribute(){
        return CalculationsClass::portionJournaliere(
            $this->montant,
            $this->date_effet->format('Y-m-d'), 
            $this->date_echeance->format('Y-m-d')
        );
    }
}
