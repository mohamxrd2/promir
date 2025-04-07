<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produit;
use App\Models\CategorieProduit;

class CategorieProduitSeeder extends Seeder
{
    public function run()
    {
        // Création de 5 catégories
        CategorieProduit::factory(5)->create()->each(function ($categorie) {
            // Pour chaque catégorie, on crée 10 produits associés
            Produit::factory(10)->create([
                'categorie_produit_id' => $categorie->id,
            ]);
        });
    }
}
