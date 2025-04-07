<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caisses extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'solde',
        'system_client_id',
    ];

    public function system_client(){
        return $this->belongsTo(System_client::class, 'system_client_id');
    }
    
    public function operations(){
        return $this->hasMany(Operation::class, 'caisse_id');
    }


}
