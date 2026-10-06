<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gift;

class GiftSeeder extends Seeder
{
    public function run(): void
    {
        $baseItems = [
            'Paquetes de Pañales', 'Biberón Anti-cólicos', 'Cobija de Texturas', 'Sonajero de Cuna',
            'Peluche Suave', 'Móvil Musical', 'Zapatitos de Tela', 'Toalla con Capucha',
            'Bañera Ergonómica', 'Kit de Aseo para Bebé', 'Set de Chupos', 'Baberos Impermeables',
            'Monitor de Sonido', 'Almohada de Lactancia', 'Silla Mecedora', 'Corral de Juegos',
            'Gimnasio de Actividades', 'Cambiador Portátil', 'Termómetro Digital', 'Set de Ropa (0-3 meses)',
            'Cochecito Paseador', 'Canguro Ergonómico', 'Tina Plegable', 'Organizador de Pañales',
            'Mordedor de Silicona', 'Calentador de Teteros', 'Set de Platos', 'Cucharas de Silicona',
            'Esterilizador de Teteros', 'Bolso Pañalero'
        ]; //

        $adjectives = [
            'de Medianoche', 'de Halloween Town', 'del Rey Calabaza', 'con Estrellas Moradas',
            'estilo Sally', 'de Magia Pura', 'de las Sombras', 'de la Luna Llena',
            'de Murciélagos', 'con Detalles Góticos', 'del Dr. Finkelstein', 'de Telarañas Suaves',
            'de Pociones', 'con Aura Violeta', 'del Bosque Encantado', 'de la Colina Espiral',
            'con Costuras Mágicas', 'de Polvo de Estrellas', 'de Sombras Alargadas', 'con Brillo Espectral'
        ]; //

        $descriptions = [
            'Un presente esencial para la cuna de Jonas Samuel, envuelto en magia nocturna.',
            'Directamente desde los talleres de Halloween Town, preparado con el mayor de los cuidados.',
            'Un detalle único y tierno que brillará en la habitación del bebé.',
            'Perfecto para las noches de desvelo, tejido con polvo de estrellas y mucho amor.',
            'El Rey Calabaza aprobó personalmente este obsequio para el pequeño monstruito.'
        ]; //

        $gifts = [];
        $count = 0; //

        // Cruzar elementos para generar exactamente 100 regalos únicos
        foreach ($baseItems as $item) { //
            // Tomamos 4 adjetivos aleatorios para cada item base (30 * 4 = 120 combinaciones posibles)
            $randomAdjectives = array_rand(array_flip($adjectives), 4); //
            
            foreach ($randomAdjectives as $adj) { //
                if ($count >= 12) break 2; // Detenerse exactamente al llegar a 100
                
                // Asignamos mayor stock a pañales y toallitas para probar el cupo múltiple
                $stock = ($item === 'Paquetes de Pañales' || $item === 'Organizador de Pañales') ? rand(3, 5) : 1;

                $demoUrl = rand(0, 1) ? 'https://www.amazon.com/s?k=' . urlencode($item) : null;

                $gifts[] = [ //
                    'name' => $item . ' ' . $adj, //
                    'description' => $descriptions[array_rand($descriptions)], //
                    'url' => $demoUrl, // Campo nuevo listo para ser usado
                    'stock' => $stock, // Campo nuevo de inventario
                    'created_at' => now(), //
                    'updated_at' => now(), //
                ];
                
                $count++; //
            }
        }

        // Inserción masiva por rendimiento
        Gift::insert($gifts); //
    }
}