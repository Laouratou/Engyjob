<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('plans')->insert([
            [
                'service_id' => 1, // Remplace par un ID de service valide
                'name' => 'Basic',
                'price' => 29000,
                'description' => 'Le meilleur pour les particuliers',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => 2, // Remplace par un ID de service valide
                'name' => 'Business',
                'price' => 39000,
                'description' => 'Le plan le plus populaire',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => 3, // Remplace par un ID de service valide
                'name' => 'unlimited',
                'price' => 69000,
                'description' => 'Sans limites & En toute liberté',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
