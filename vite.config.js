import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '@fortawesome/fontawesome-free': '/node_modules/@fortawesome/fontawesome-free',
        },
    },
    server: {
        host: '192.168.1.4',
        hmr: {
            host: '192.168.1.4',
        },
    },
});
