<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modaliteEchellonneeDetteClient extends Model
{
    use HasFactory;
    protected $fillable = [
        'dettes_client_id',
        'montant',
        'status',
        'date_reglement',
    ];

    public function dette(){
        return $this->belongsTo(DettesClients::class,'dettes_client_id');
    }
}
