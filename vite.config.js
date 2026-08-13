import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "modules/common/resources/css/common.scss",
                "modules/common/resources/js/common.js",
            ],
            assets: [
                'app-modules/common/resources/images/**',
            ],
            refresh: true,
        }),
    ],
    server: {
        watch: {
            ignored: ["**/storage/framework/views/**"],
        },
    },
});
