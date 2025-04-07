<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pointage extends Model
{
    use HasFactory;
    protected $filable = [
        'h_arrivee',
        'h_fin',
        'periode',
        'personnel_id'
    ];

    public function personnel(){
        return $this->belongsTo(Personnel::class);
    }
}

