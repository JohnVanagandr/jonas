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
            'email' => 'admin@halloweentown.com',
            'password' => Hash::make('Jack1234!'),
        ]);

        // Ejecutamos nuestros 100 regalos mágicos
        $this->call([
            GiftSeeder::class,
        ]);
    }
}