import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/src/assets/sass/index.scss',
                'resources/src/index.ts'
            ],
            refresh: true,
        }),
    ],
});
