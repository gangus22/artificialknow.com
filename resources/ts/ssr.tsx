/* eslint-disable */
import { createInertiaApp } from "@inertiajs/react";
import ReactDOMServer from "react-dom/server";
import createServer from "@inertiajs/react/server";
import React from "react";

createServer((page) =>
    createInertiaApp({
        page,
        render: ReactDOMServer.renderToString,
        resolve: (name) => {
            const pages = import.meta.glob("./Inertia/**/*Page.tsx", {
                eager: true,
            });
            return pages[`./Inertia/${name}.tsx`];
        },
        setup: ({ App, props }) => <App {...props} />,
    })
);
