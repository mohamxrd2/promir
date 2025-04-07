<?php

namespace App\Models;

use App\Classes\CalculationsClass;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlansEpargne extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
        'montant',
        'periodicite',
        'system_client_id'
    ];

    public function system_client() {
        return $this->belongsTo(System_client::class);
    }


    public function provision(){
        return $this->morphOne(Provision::class, 'engageable');

    }

    protected function getCumulAttribute(){
        $daysUntilToday = CalculationsClass::calculateWorkingDaysBetweenDates($this->created_at, Carbon::today()->format('Y-m-d'));
        $daysUntilYesterday = $daysUntilToday - 1;
        return $daysUntilYesterday;
    }
}