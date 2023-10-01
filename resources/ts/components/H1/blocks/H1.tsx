import React, { PropsWithChildren } from "react";

export const H1: React.FC<PropsWithChildren> = ({ children }) => (
    <h1 className="font-sans text-5xl font-black">{children}</h1>
);
