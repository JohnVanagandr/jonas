import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        host: '0.0.0.0', // Permite escuchar conexiones de toda la red local
        port: 5174,
        cors: true,       // Habilita cabeceras Access-Control-Allow-Origin
        hmr: {
            host: '192.168.1.8', // Tu IP local exacta para la recarga en caliente
        },
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});