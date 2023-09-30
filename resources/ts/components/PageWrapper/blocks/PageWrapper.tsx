import React, { PropsWithChildren } from "react";
import { LayoutNavbar } from "../../LayoutNavbar/blocks/LayoutNavbar";

export const PageWrapper: React.FC<PropsWithChildren> = ({ children }) => (
    <div className="h-full w-full bg-secondary-50">
        <div className="h-full lg:container lg:mx-auto">
            <LayoutNavbar />
            {children}
            <div className="h-screen w-full rounded-lg border border-slate-700">
                footer placeholder
            </div>
        </div>
    </div>
);
