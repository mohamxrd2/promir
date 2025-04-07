<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LigneVente extends Model
{
    use HasFactory;
      protected $fillable = [
        'quantite_envoyee',
        'prix_reel_vente',
        'type_de_produit_a_vendre',
        'quantite_vendue',
        'montant_regle',
        'prix_vente',
        'service_id',
        'system_produit_id',
        'produit_transforme_id',
        'vente_id',
    ];

    public function vente(){
        return $this->belongsTo(Ventes::class, 'vente_id');
    }

    public function systemeProduit(){
        return $this->belongsTo(System_produit::class, 'system_produit_id');
    }
    public function service(){
        return $this->belongsTo(Services::class);
    }

    public function produitTransforme(){
        return $this->belongsTo(ProduitTransforme::class, 'produit_transforme_id');
    }


    public function detteClient(){
        return $this->hasOne(DettesClients::class, 'ligne_vente_id');   
    }
    
    public function avanceClient(){
        return $this->hasOne(AvanceClient::class, 'ligne_vente_id');   
    }

    public function produitsUtilises(){
        return $this->hasMany(ProduitService::class, 'ligne_vente_id');
    } 
   
}