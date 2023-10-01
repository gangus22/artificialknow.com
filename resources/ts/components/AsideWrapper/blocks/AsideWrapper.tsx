import React, { PropsWithChildren } from "react";

export const AsideWrapper: React.FC<PropsWithChildren> = ({ children }) => (
    <aside className="hidden w-1/3 font-sans md:block">{children}</aside>
);
