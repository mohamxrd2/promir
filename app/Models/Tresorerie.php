<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tresorerie extends Model
{
    protected $fillable = [
        'annee',
        'system_client_id',
    ];


    public function contenuMois(){
        return $this->hasMany(TresorerieMois::class, "tresorerie_id");
    }
    
    public function entreprise(){
        return $this->belongsTo(System_client::class, "system_client_id");
    }
}
