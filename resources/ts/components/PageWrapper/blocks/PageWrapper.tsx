import React, { PropsWithChildren } from "react";
import { LayoutNavbar } from "../../LayoutNavbar/blocks/LayoutNavbar";
import { PageContext } from "../../../contexts/PageContext";
import { Page } from "../../../models/Page";

export const PageWrapper: React.FC<PropsWithChildren<{ page: Page }>> = ({
    page,
    children,
}) => (
    <div className="flex h-full w-full flex-col gap-y-10">
        <LayoutNavbar />
        <div className="flex h-full flex-col gap-y-10 lg:container lg:mx-auto">
            <PageContext.Provider value={page}>{children}</PageContext.Provider>
        </div>
        <div className="h-screen w-full rounded-lg border border-slate-700">
            footer placeholder
        </div>
    </div>
);
