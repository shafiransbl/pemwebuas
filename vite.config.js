import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/css/app.css',
                'resources/css/index.css',
                'resources/css/show.css',
                'resources/css/edit-create.css',
            ],
            refresh: true,
        }),
    ],
});
