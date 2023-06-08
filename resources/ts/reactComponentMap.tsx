import React from "react";

export const reactComponentMap: {
    [component: string]: Promise<React.FunctionComponent<any>>;
} = {
    ExampleComponent: import("./ExampleModule/ExampleComponent").then(
        (m) => m.ExampleComponent
    ),
    LayoutNavbar: import("./LayoutNavbar/LayoutNavbar").then(
        (m) => m.LayoutNavbar
    ),
};
