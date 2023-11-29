import React, { Fragment } from "react";
import { ChevronRightIcon } from "@heroicons/react/24/outline";
import { BreadcrumbsItem } from "../types/BreadcrumbsItem";
import { BreadcrumbListSchemaMarkup } from "./BreadcrumbListSchemaMarkup";

export const Breadcrumbs: React.FC<{
    breadcrumbs: BreadcrumbsItem[];
}> = ({ breadcrumbs }) => (
    <div className="flex w-max items-center gap-x-1 rounded-full px-4 py-2 text-sm bg-secondary-100">
        <BreadcrumbListSchemaMarkup breadcrumbs={breadcrumbs} />
        {breadcrumbs.map((breadcrumb, index) => (
            <Fragment key={breadcrumb.name}>
                {index === breadcrumbs.length - 1 ? (
                    <span className="hidden md:inline" key={breadcrumb.url}>
                        {breadcrumb.name}
                    </span>
                ) : (
                    <>
                        <ChevronRightIcon className="second-to-last-of-type:block hidden h-4 w-4 rotate-180 md:second-to-last-of-type:hidden md:hidden" />
                        <a
                            className="last-of-type:block hidden text-secondary-800 hover:underline md:block"
                            href={breadcrumb.url}
                        >
                            {breadcrumb.name}
                        </a>
                        <ChevronRightIcon className="hidden h-4 w-4 md:block" />
                    </>
                )}
            </Fragment>
        ))}
    </div>
);
