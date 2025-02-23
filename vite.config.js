import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue'; // 🔹 Importa el plugin de Vue
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js'],
            refresh: true,
        }),
        vue(), // 🔹 Agrega el plugin de Vue aquí
    ],
});
