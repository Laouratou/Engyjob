<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 111111, // Assurez-vous de sécuriser le mot de passe correctement
            'user_type' => 'admin', // Utilisation de user_type au lieu de role
        ]);
    }
}
