import { createInertiaApp } from "@inertiajs/react";
import { createRoot } from "react-dom/client";
import React from "react";

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./Inertia/**/*Page.tsx", {
            eager: true,
        });
        return pages[`./Inertia/${name}.tsx`];
    },
    setup({ el, App, props }) {
        createRoot(el).render(<App {...props} />);
    },
}).then();
