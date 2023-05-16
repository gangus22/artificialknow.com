import "./bootstrap";
import { createRoot } from "react-dom/client";
import React from "react";
import { ExampleComponent } from "./ExampleModule/ExampleComponent";

console.log("TS app entry point!");

// TODO: render based on dynamic import. Make extension .ts. Multiple roots for individual components are OK
const rootNode = document.getElementById("react-root");
const reactRoot = createRoot(rootNode!);

reactRoot.render(<ExampleComponent />);
