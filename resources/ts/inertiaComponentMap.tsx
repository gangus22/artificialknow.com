export const inertiaComponentMap: { [component: string]: Promise<any> } = {
    ExampleComponent: import("./ExampleModule/ExampleComponent"),
    LayoutNavbar: import("./LayoutNavbar/LayoutNavbar"),
};
