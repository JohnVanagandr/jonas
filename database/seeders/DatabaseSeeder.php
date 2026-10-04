<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Creamos al Rey Calabaza (Administrador)
        User::factory()->create([
            'name' => 'Rey Calabaza',
            'email' => 'jfbeccera@gmail.com',
            'password' => Hash::make('JonasBecerra'),
        ]);

        // Ejecutamos nuestros 100 regalos mágicos
        $this->call([
            GiftSeeder::class,
        ]);
    }
}