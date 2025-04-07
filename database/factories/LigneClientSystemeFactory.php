<?php

namespace Database\Factories;

use App\Models\LigneClientSysteme;
use App\Models\Clients;
use App\Models\System_client;
use Illuminate\Database\Eloquent\Factories\Factory;

class LigneClientSystemeFactory extends Factory
{
    protected $model = LigneClientSysteme::class;

    public function definition()
    {
        do {
            $client_id = Clients::inRandomOrder()->first()->id ?? Clients::factory()->create()->id;
            $system_client_id = System_client::inRandomOrder()->first()->id ?? System_client::factory()->create()->id;
        } while (LigneClientSysteme::where('client_id', $client_id)
            ->where('system_client_id', $system_client_id)
            ->exists()
        ); // Vérifie si cette relation existe déjà

        return [
            'client_id' => $client_id,
            'system_client_id' => $system_client_id,
        ];
    }
}
