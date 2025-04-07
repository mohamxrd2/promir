<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class typesDepense extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
    ];

    public function depenses(){
        return $this->hasMany(Depense::class, 'type_depense_id');
    }
}
