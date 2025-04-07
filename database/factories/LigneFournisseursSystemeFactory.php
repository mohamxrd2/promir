<?php

namespace Database\Factories;

use App\Models\LigneFournisseursSysteme;
use App\Models\Fournisseurs;
use App\Models\System_client;
use Illuminate\Database\Eloquent\Factories\Factory;

class LigneFournisseursSystemeFactory extends Factory
{
    protected $model = LigneFournisseursSysteme::class;

    public function definition()
    {
        return [
            'est_potentiel' => $this->faker->boolean,
            'system_client_id' => System_client::inRandomOrder()->first()->id ?? System_client::factory(),
            'fournisseur_id' => Fournisseurs::inRandomOrder()->first()->id ?? Fournisseurs::factory(),
        ];
    }
}
