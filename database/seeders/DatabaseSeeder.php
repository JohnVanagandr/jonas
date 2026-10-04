<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Gift;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear el único administrador
        User::factory()->create([
            'name' => 'El Rey Calabaza',
            'email' => 'admin@halloweentown.com',
            'password' => Hash::make('Jack1234!'), // Contraseña de acceso
        ]);

        // 2. Crear regalos temáticos de prueba
        $gifts = [
            ['name' => 'Poción de Sombra Nocturna', 'description' => 'Un frasco con la esencia de las pesadillas más dulces.'],
            ['name' => 'Muñeco de Trapo Remendado', 'description' => 'Hecho a mano, ideal para hacer compañía en la oscuridad.'],
            ['name' => 'Araña de Cristal', 'description' => 'Una hermosa y espeluznante araña decorativa.'],
            ['name' => 'Libro de Hechizos Gastronómicos', 'description' => 'Recetas con ingredientes como Aliento de Rana y Mostaza de Murciélago.'],
            ['name' => 'Caja Sorpresa Cíclope', 'description' => 'Nadie sabe qué hay dentro, pero te está mirando.'],
        ];

        foreach ($gifts as $gift) {
            Gift::create($gift);
        }
    }
}