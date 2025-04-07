<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class System_client extends Model
{
    use HasFactory;
    protected $fillable = [
        'deno_sociale',
        'sigle',
        'type',
        'devise',
        'date_creation',
        'pays',
        'region',
        'localite',
        'adresse_geographique',
        'tel',
        'cel',
        'mail_entreprise',
        'lien_page_fbook',
        'lien_site_web',
        'capital_social',
        'nbr_employes',
        'chiffre_affaire',
        'sect_activite',
        'regime_fiscal',
        'num_cnps',
        'centre_impot',
        'status_compte',
        'logo_image',
    ];
    public function user()
    {
        return $this->hasMany(User::class, 'system_client_id');
    }

    function jours_de_repos() {
        return $this->belongsToMany(jour_de_repos::class, 'jour_de_repo_system_clients','system_client_id', 'jour_de_repo_id');
    }
    

    public function plans_epargne()
    {
        return $this->hasMany(PlansEpargne::class);
    }

    public function caisses()
    {
        return $this->hasMany(Caisses::class, 'system_client_id');
    }


    public function livraisons()
    {
        return $this->hasMany(Livraisons::class);
    }

    public function systemeProduits()
    {
        return $this->hasMany(System_produit::class, 'system_client_id');
    }

    public function depenses(){
        return $this->hasMany(Depense::class, 'system_client_id');
    }
    
    public function dettesFinqncieres(){
        return $this->hasMany(DetteFinanciere::class, 'system_client_id');
    }
    
    public function personnels(){
        return $this->hasMany(Personnel::class, 'system_client_id');
    }

    public function revenuExceptionnel(){
        return $this->hasMany(RevenuExceptionnel::class, 'system_client_id');
    }
    
    
    public function investissements(){
        return $this->hasMany(Investissements::class, 'system_client_id');
    }
}
