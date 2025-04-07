<?php

namespace App\Models;

use App\Classes\MainClass;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    use HasFactory;
    protected $fillable = [
        'nbr_portions',
        'produit_transforme_id',
    ];

    public function produitTransforme(){
        return $this->belongsTo(ProduitTransforme::class, 'produit_transforme_id');
    }


    public function produitsBruts(){
        return $this->belongsToMany(System_produit::class, 'production_produitbruts', 'production_id', 'system_produit_id')->withPivot('quantite_utilisee');
    }  

    public function personnel(){
        return $this->belongsToMany(Personnel::class, 'personnel_productions' ,'production_id', 'personnel_id')->withPivot('heures');
    }


    public function getCoutProduitsAttribute(){
        $cout_produit = $this->produitsBruts->sum(function($produit){
            return $produit->pivot->quantite_utilisee ?? 0 * $produit->pua ?? 0;
        });
        return round($cout_produit, 4);
    }

    public function getCoutPersonnelAttribute(){
        // Le coût du personnel en fonction du salaire, des heures travaillées et des jours travaillés
        $cout_personnel = $this->personnel->sum(function($agent) {
            $contrat = $agent->contrat;
            $nbrJours = $contrat->nbr_jour_tr_pj > 0 
                ? $contrat->nbr_jour_tr_pj 
                : MainClass::getNumberOfWorkingDaysInThisMonth();
    
            if ($contrat->salaire_mensuel && $contrat->nbr_h_tr_pj > 0 && $nbrJours > 0) {
                $coutHoraire = $contrat->salaire_mensuel / ($contrat->nbr_h_tr_pj * $nbrJours);
                return $agent->pivot->heures * $coutHoraire;
            }
            return 0;
        });
        return round($cout_personnel, 4);
    }
     
    public function getMargeBruteAttribute(){
        if(!$this->produitTransforme) return 0;
        return round($this->nbr_portions * $this->produitTransforme->prix_unitaire_portion - ($this->cout_personnel + $this->cout_produits),4);
    }
    
    public function getMontantAttribute(){
        if(!$this->produitTransforme) return 0;
        return round($this->nbr_portions * $this->produitTransforme->prix_unitaire_portion, 4);
    }
}