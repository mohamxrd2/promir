<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\System_client;
use App\Models\ProduitTransforme;
use App\Models\Approvisionnement;
use App\Models\Produit;
class System_produit extends Model
{
    use HasFactory;
    protected $fillable = [
        'qte_stck',
        'qte_stck_satic_apres_appro',
        'nombre_pieces',
        'nombre_portions',
        'puv',
        'pua',
        'system_client_id',
        'produit_id',
        'portion',
        'nom_piece',
    ];

    
    public function produit(){
        return $this->belongsTo(Produit::class, 'produit_id');
    }

    public function systemeClient(){
        return $this->belongsTo(System_client::class, 'system_client_id');
    }

    public function productions(){
        return $this->belongsToMany(Production::class, 'production_produitbruts', 'system_produit_id', 'production_id');
    }
    
    public function approvisionnements(){
        return $this->belongsToMany(Approvisionnement::class, 'approvisionnement_system_produit', 'system_produit_id', 'approvisionnement_id');
    }






    public function lignesVentes(){
        return $this->hasMany(LigneVente::class, 'system_produit_id');
    }

    public function prestations(){
        return $this->belongsToMany(PrestationService::class, 'prestation_service_system_produits' ,'system_produit_id', 'prestation_service_id');
    }









    public function livraisons(){
        return $this->hasMany(Livraisons::class, 'system_produit_id');
    }
    public function avancesClient(){
        return $this->hasMany(AvanceClient::class, 'system_produit_id');
    }

    public function utilisationPourPresterService(){
        return $this->hasMany(ProduitService::class, 'system_produit_id');
    } 


    public function inventaires(){
        return $this->morphMany(Inventaire::class, 'produitable');
    }
}