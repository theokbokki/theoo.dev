import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { local } from 'laravel-vite-plugin/fonts';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.scss', 'resources/js/app.js'],
            refresh: true,
            assets: [
                'resources/img/**',
                'resources/icons/**',
            ],
            fonts: [
                local('Comic Sans MS', {
                    alias: 'comic',
                    variants: [
                        {
                            src: ['resources/fonts/comic-sans-ms/ComicSansMS.woff2', 'resources/fonts/comic-sans-ms/ComicSansMS.woff', 'resources/fonts/comic-sans-ms/ComicSansMS.ttf'],
                            weight: 400,
                        }
                    ],
                }),
            ],
        }),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
