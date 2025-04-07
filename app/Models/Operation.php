<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'montant',
        'caisse_id',
    ];


    public function caisse(){
        return $this->belongsTo(Caisses::class, 'caisse_id');
    }
}
