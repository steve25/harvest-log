import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        proxy: {
            "/weighings": "http://localhost:8000",
            "/sanctum": "http://localhost:8000",
            "/field-crops": "http://localhost:8000",
            // voliteľne všetko:
            "^/.*": {
                target: "http://localhost:8000",
                changeOrigin: true,
            },
        },
    },
});
