<?php

namespace App\Http\Controllers\produits;

use App\Http\Controllers\Controller;
use App\Models\Produit;

class ProduitController extends Controller
{
    public function index(){
        $produits = Produit::where('produit_id', '')->orderBy('designation')->get();
        $vue = view('produits.produits', compact(['produits']));
        return $vue;
    }
}


