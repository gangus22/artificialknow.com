import "./bootstrap";
import { createInertiaApp } from "@inertiajs/react";
import { createRoot } from "react-dom/client";
import React from "react";
import { ExampleComponent } from "./ExampleModule/ExampleComponent";

console.log("TS app entry point!");

// TODO: render based on dynamic import. Make extension .ts. Multiple roots for individual components are OK
const rootNode = document.getElementById("react-root");
const reactRoot = createRoot(rootNode!);
reactRoot.render(<ExampleComponent />);

// TODO: implement navbar component

// TODO: figure out what the hell this does and make the console errors go away
createInertiaApp({
    id: "react-root",
    resolve: (name) => {
        const pages = import.meta.glob("./inertiaPages/**/*.tsx", {
            eager: true,
        });
        console.log(pages);
        return pages[`./Pages/${name}.jsx`];
    },
    setup({ el, App, props }) {
        createRoot(el).render(<App {...props} />);
    },
});
