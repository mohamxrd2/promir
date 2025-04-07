<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DateOfDay extends Model
{
    use HasFactory;
    protected $table = 'date_of_days';
    protected $fillable = ['date'];
    protected $dates = ['date'];

    
    public function ventes(){
        return $this->hasMany(Ventes::class);
    }
}

