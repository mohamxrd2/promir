<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonnelProduction extends Model
{
    use HasFactory;
    protected $fillable = ['heures'];
}
