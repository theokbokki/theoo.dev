import tailwindcss from "@tailwindcss/vite";
import react from "@vitejs/plugin-react";
import laravel from "laravel-vite-plugin";
import path from "path";
import { defineConfig } from "vite";
import glsl from "vite-plugin-glsl";

export default defineConfig({
    plugins: [
        react(),
        tailwindcss(),
        glsl(),
        laravel({
            input: ["resources/css/app.css", "resources/js/app.jsx"],
            ssr: "resources/js/ssr.jsx",
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            "@": path.resolve(__dirname, "resources/js"),
            "@rsc": path.resolve(__dirname, "resources"),
        },
    },
});
