<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jour_de_repo_system_client extends Model
{
    use HasFactory;
    protected $fillable = [
        'system_client_id',
        'jour_de_repo_id',
    ];
}
