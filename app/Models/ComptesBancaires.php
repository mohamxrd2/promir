<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComptesBancaires extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_iban',
        'numero_bic',
        'code_banque',
        'code_guichet',
        'cle_rib',
        'domiciliation',
        'numero_compte',
        'cle_iban',
        'solde',
        'devise',
        'type',
        'date_creation',
        'system_client_id',
        'banque_id',
    ];


    public function system_client(){
        return $this->belongsTo(System_client::class);
    }
    
    public function banque(){
        return $this->belongsTo(Banque::class, 'banque_id');
    }

}
