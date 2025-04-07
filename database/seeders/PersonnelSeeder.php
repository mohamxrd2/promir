<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Personnel;

class PersonnelSeeder extends Seeder
{
    public function run(): void
    {
        Personnel::factory()->count(10)->create(); // Génère 50 personnels
    }
}
