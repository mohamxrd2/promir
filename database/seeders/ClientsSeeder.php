<?php

namespace Database\Seeders;

use App\Models\LigneClientSysteme;
use App\Models\System_client;
use Illuminate\Database\Seeder;
use App\Models\Clients;

class ClientsSeeder extends Seeder
{
    public function run()
    {
        // Vérifier s'il y a déjà des clients et des systèmes
        if (Clients::count() == 0) {
            Clients::factory(2)->create();
        }

        if (System_client::count() == 0) {
            System_client::factory(5)->create(); // Ajoute 5 systèmes clients si la table est vide
        }

        // Récupérer tous les clients et systèmes après les éventuelles insertions
        $clients = Clients::all();
        $systemes = System_client::all();

        foreach ($clients as $client) {
            // S'assurer qu'il y a bien des systèmes clients avant de randomiser
            if ($systemes->isNotEmpty()) {
                $systemesAssocies = $systemes->random(rand(1, min(3, $systemes->count())));

                foreach ($systemesAssocies as $systeme) {
                    LigneClientSysteme::firstOrCreate([
                        'client_id' => $client->id,
                        'system_client_id' => $systeme->id,
                    ]);
                }
            }
        }
    }
}
