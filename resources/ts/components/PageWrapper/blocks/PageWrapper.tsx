import React, { PropsWithChildren } from "react";
import { LayoutNavbar } from "../../LayoutNavbar/blocks/LayoutNavbar";

export const PageWrapper: React.FC<PropsWithChildren> = ({ children }) => (
    <div className="h-full w-full py-5 main-page-bg-gradient">
        <div className="sticky top-4 z-50 mx-auto mb-5 w-[95%]">
            <LayoutNavbar />
        </div>
        {children}
        <div className="mx-auto my-5 h-screen w-full rounded-lg border border-slate-700">
            footer placeholder
        </div>
    </div>
);
