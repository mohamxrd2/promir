<?php

namespace Database\Factories;

use App\Models\Fournisseurs;
use Illuminate\Database\Eloquent\Factories\Factory;

class FournisseursFactory extends Factory
{
    protected $model = Fournisseurs::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->company,
            'type' => $this->faker->randomElement(['Local', 'International']),
            'adresse' => $this->faker->address,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'seconde_phone' => $this->faker->optional()->phoneNumber,
            'pays' => $this->faker->country,
            'region' => $this->faker->state,
            'departement' => $this->faker->city,
            'localite' => $this->faker->streetName,
        ];
    }
}
