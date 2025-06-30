import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/print-prev.css',
                'resources/js/activity-logs.js',
            ],
            refresh: true,
        }),
    ],
});
