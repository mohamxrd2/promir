<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RevenuExceptionnel extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'montant',
        'system_client_id',
    ];


    public function entreprise(){
        return $this->belongsTo(System_client::class, 'system_client_id');
    }
}



