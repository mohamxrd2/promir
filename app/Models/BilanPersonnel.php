<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BilanPersonnel extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
    ];


    
    public function compositions(){
        return $this->hasMany(CompositionBilanPersonnel::class, 'bilan_personnel_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
