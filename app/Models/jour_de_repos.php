<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jour_de_repos extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
    ];

    function system_client () {
        return $this->belongsToMany(System_client::class, 'jour_de_repo_system_clients','jour_de_repo_id', 'system_client_id');
    }
}
