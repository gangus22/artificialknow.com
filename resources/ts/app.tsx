import "./bootstrap";
import { createRoot } from "react-dom/client";
import React from "react";
import { reactComponentMap } from "./reactComponentMap";

const reactComponentPrefix = "react-from-blade-";

// TODO: encode and pass down props
document
    .querySelectorAll(`*[class^=${reactComponentPrefix}]`)
    .forEach(async (element) => {
        const componentName = element.className.split(reactComponentPrefix)[1];
        const Component = await reactComponentMap[componentName];
        createRoot(element).render(<Component />);
    });

// TODO: implement SSR
/*
 * createInertiaApp({
 *     resolve: async (name) => reactComponentMap[name],
 *     setup({ el, App, props }) {
 *         console.log(el);
 *         createRoot(el).render(<App {...props} />);
 *     },
 * }).then();
 */
