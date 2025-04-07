<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Psy\Readline\Hoa\Console;

class modalitePeriodiqueDetteClient extends Model
{
    use HasFactory;
    protected $fillable = [
        'dettes_client_id',
        'montant',
        'status',
        'periodicite_payement',
        'nombre_depayement',
    ];

    public function dette(){
        
        return $this->belongsTo(DettesClients::class,'dettes_client_id');
    }


}