import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/home/common/cms.js',
                'resources/js/home/common/ecommerce.js'
            ],
            refresh: true,
        }),
    ],
});
