import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import glsl from "vite-plugin-glsl";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.scss", "resources/js/app.js"],
            refresh: ["resources/views/**", "app/View/Components/**", "storage/app/private/notes/**"],
        }),
        glsl(),
    ],
});
