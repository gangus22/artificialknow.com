import React, { PropsWithChildren } from "react";
import { LayoutNavbar } from "../../LayoutNavbar/blocks/LayoutNavbar";
import { PageContext } from "../../../contexts/PageContext";
import { Page } from "../../../models/Page";
import { OrganizationSchemaMarkup } from "../schema/OrganizationSchemaMarkup";
import { PageFooter } from "../../PageFooter/blocks/PageFooter";

export const PageWrapper: React.FC<
    PropsWithChildren<{ page?: Page | undefined }>
> = ({ page, children }) => (
    <div className="flex h-full min-h-screen w-full flex-col gap-y-8">
        <LayoutNavbar />
        <OrganizationSchemaMarkup />
        <div className="flex h-full flex-col gap-y-10 p-5 pt-0 lg:container lg:mx-auto">
            <PageContext.Provider value={page}>{children}</PageContext.Provider>
        </div>
        <PageFooter />
    </div>
);
