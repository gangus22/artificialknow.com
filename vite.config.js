import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import react from "@vitejs/plugin-react";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/tailwind.css",
                "resources/ts/inertia-app.tsx",
            ],
            ssr: "resources/ts/ssr.tsx",
            refresh: true,
            valetTls: "artificialknow.test",
        }),
        react(),
    ],
});
