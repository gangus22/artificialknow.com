import React, { PropsWithChildren } from "react";
import { LayoutNavbar } from "../../LayoutNavbar/blocks/LayoutNavbar";

export const PageWrapper: React.FC<PropsWithChildren> = ({ children }) => (
    <div className="flex h-full w-full flex-col gap-y-10">
        <LayoutNavbar />
        <div className="flex h-full flex-col gap-y-10 lg:container lg:mx-auto">
            {children}
        </div>
        <div className="h-screen w-full rounded-lg border border-slate-700">
            footer placeholder
        </div>
    </div>
);
