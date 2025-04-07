<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaire extends Model
{
    use HasFactory;
    protected $fillable = [
        'produitable_type',
        'produitable_id',
        'quantite_theorique',
        'prix_unitaire',
        'quantite_physique', 
        'portions',       
        'unites',       
        'date_inventaire',
    ];

    public function produitable(){
        return $this->morphTo('produitable');
    }

    public function getEcartAttribute(){
        return $this->quantite_physique -  $this->quantite_theorique;
    }
    
    public function getValeurTheoriqueAttribute(){
        return $this->prix_unitaire *  $this->quantite_theorique;
    }
    
    public function getValeurPhysiqueAttribute(){
        return $this->prix_unitaire *  $this->quantite_physique;
    }
    
    public function getValeurEcartAttribute(){
        return $this->getEcartAttribute() * $this->prix_unitaire;
    }
}