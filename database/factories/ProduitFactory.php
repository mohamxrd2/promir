<?php

namespace Database\Factories;

use App\Models\Produit;
use App\Models\CategorieProduit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produit>
 */
class ProduitFactory extends Factory
{
    protected $model = Produit::class;

    public function definition()
    {
        return [
            'reference' => strtoupper($this->faker->bothify('REF-####')), // Génère REF-1234
            'designation' => $this->faker->words(3, true), // "Produit XYZ"
            'format' => $this->faker->randomElement(['Petit', 'Moyen', 'Grand']),
            'type' => $this->faker->randomElement(['Alimentaire', 'Électronique', 'Textile']),
            'calibrage' => $this->faker->numberBetween(1, 10), // Nombre aléatoire entre 1 et 10
            'conditionnement' => $this->faker->randomElement(['Unité', 'Boîte', 'Carton']),
            'image' => $this->faker->imageUrl(200, 200, 'product'), // URL d'image aléatoire
            'categorie_produit_id' => CategorieProduit::factory(), // Associe une catégorie aléatoire
        ];
    }
}
