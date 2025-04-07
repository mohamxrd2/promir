<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fournisseurs;
use App\Models\LigneFournisseursSysteme;
use App\Models\System_client;

class FournisseursSeeder extends Seeder
{
    public function run()
    {
        // Vérifier s'il existe déjà des fournisseurs et des systèmes clients
        if (Fournisseurs::count() == 0) {
            Fournisseurs::factory(10)->create();
        }

        if (System_client::count() == 0) {
            System_client::factory(5)->create();
        }

        // Récupérer tous les fournisseurs et systèmes clients
        $fournisseurs = Fournisseurs::all();
        $systemes = System_client::all();

        foreach ($fournisseurs as $fournisseur) {
            // Associer chaque fournisseur à un ou plusieurs systèmes clients
            $systemesAssocies = $systemes->random(rand(1, min(3, $systemes->count())));

            foreach ($systemesAssocies as $systeme) {
                LigneFournisseursSysteme::firstOrCreate([
                    'fournisseur_id' => $fournisseur->id,
                    'system_client_id' => $systeme->id,
                ]);
            }
        }
    }
}
