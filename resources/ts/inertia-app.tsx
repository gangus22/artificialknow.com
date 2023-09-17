import { createInertiaApp } from "@inertiajs/react";
import { hydrateRoot } from "react-dom/client";
import React from "react";

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./Inertia/**/*Page.tsx", {
            eager: true,
        });
        return pages[`./Inertia/${name}.tsx`];
    },
    setup({ el, App, props }) {
        hydrateRoot(el, <App {...props} />);
    },
}).then();
