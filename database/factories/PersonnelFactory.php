<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Personnel;
use Illuminate\Support\Str;

class PersonnelFactory extends Factory
{
    protected $model = Personnel::class;

    public function definition(): array
    {
        return [
            'matricule' => strtoupper(Str::random(10)),
            'nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,
            'date_de_naissance' => $this->faker->date(),
            'date_recrutement' => $this->faker->date(),
            'lieu_de_naissance' => $this->faker->city,
            'situation_matrimoniale' => $this->faker->randomElement(['Célibataire', 'Marié(e)', 'Divorcé(e)', 'Veuf(ve)']),
            'nombre_enfants' => $this->faker->numberBetween(0, 5),
            'titre_poste' => $this->faker->jobTitle,
            'num_cnps' => $this->faker->numerify('CNPS-#####'),
            'secteurIntervention' => $this->faker->word,
            'Nationalite' => $this->faker->country,
            'tel' => $this->faker->phoneNumber,
            'photo' => $this->faker->imageUrl(200, 200, 'people'),
            'system_client_id' => 2, // Modifie selon ta logique
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
