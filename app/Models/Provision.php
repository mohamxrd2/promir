<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provision extends Model
{
    protected $fillable = [
        'engageable_type',
        'engageable_id',
        'montant',
    ];

    public function engageable(){
        return $this->morphTo(name: 'engageable');
    }
}
