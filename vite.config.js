import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import react from "@vitejs/plugin-react";

// TODO: add server-side rendering as a SEO improvement (InertiaJS)
export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/tailwind.css",
                "resources/ts/inertia-app.tsx",
            ],
            ssr: "resources/ts/ssr.tsx",
            refresh: true,
        }),
        react(),
    ],
});
