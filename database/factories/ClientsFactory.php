<?php

namespace Database\Factories;

use App\Models\Clients;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientsFactory extends Factory
{
    protected $model = Clients::class;

    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['Particulier', 'Entreprise']),
            'nom' => $this->faker->company, // Nom d'entreprise ou nom aléatoire
            'adresse' => $this->faker->address,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'seconde_phone' => $this->faker->phoneNumber, // Peut être null
            'region' => $this->faker->state,
            'departement' => $this->faker->city,
            'localite' => $this->faker->streetName,
            'pays' => $this->faker->country,
        ];
    }
    
}
