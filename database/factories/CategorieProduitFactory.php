<?php

namespace Database\Factories;

use App\Models\CategorieProduit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CategorieProduit>
 */
class CategorieProduitFactory extends Factory
{
    protected $model = CategorieProduit::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->word, // Nom aléatoire pour la catégorie
        ];
    }
}
