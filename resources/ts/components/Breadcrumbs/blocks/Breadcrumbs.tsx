import React from "react";
import { ChevronRightIcon } from "@heroicons/react/24/outline";

export const Breadcrumbs: React.FC<{
    breadcrumbs: Object;
}> = ({ breadcrumbs }) => {
    const breadcrumbEntries = Object.entries(breadcrumbs);
    return (
        <div className="flex w-max items-center gap-x-1 rounded-full px-4 py-2 text-sm bg-secondary-100">
            {breadcrumbEntries.map(([breadcrumb, link], index) => (
                <>
                    {index === breadcrumbEntries.length - 1 ? (
                        <span className="hidden md:inline" key={link}>
                            {breadcrumb}
                        </span>
                    ) : (
                        <>
                            <ChevronRightIcon className="second-to-last-of-type:block hidden h-4 w-4 rotate-180 md:second-to-last-of-type:hidden md:hidden" />
                            <a
                                className="last-of-type:block hidden text-secondary-800 hover:underline md:block"
                                href={link}
                            >
                                {breadcrumb}
                            </a>
                            <ChevronRightIcon className="hidden h-4 w-4 md:block" />
                        </>
                    )}
                </>
            ))}
        </div>
    );
};
