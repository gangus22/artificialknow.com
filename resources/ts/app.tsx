import "./bootstrap";
import { createRoot } from "react-dom/client";
import React from "react";
import { createInertiaApp } from "@inertiajs/react";
import { inertiaComponentMap } from "./inertiaComponentMap";

createInertiaApp({
    resolve: async (name) => inertiaComponentMap[name],
    setup({ el, App, props }) {
        createRoot(el).render(<App {...props} />);
    },
}).then();
