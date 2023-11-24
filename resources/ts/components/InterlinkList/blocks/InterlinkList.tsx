import React from "react";
import { NewspaperIcon } from "@heroicons/react/24/outline";
import { InterlinkItem } from "../types/InterlinkItem";

export const InterlinkList: React.FC<{ interlinks: InterlinkItem[] }> = ({
    interlinks,
}) => (
    <>
        {interlinks.length > 0 && (
            <div className="class flex flex-col gap-y-4 my-2 p-4 rounded-lg bg-secondary-50">
                <div className="text-lg md:text-xl font-black">
                    Want to know more?
                </div>
                <div className="flex flex-col gap-y-2 gap-x-2 text-secondary-900 text-base font-semibold transition-colors">
                    {interlinks.map((interlinkItem) => (
                        <a
                            href={interlinkItem.url}
                            className="p-2 w-fit flex items-center gap-x-2 hover:bg-secondary-100 hover:underline rounded-lg"
                            key={interlinkItem.url}
                        >
                            <NewspaperIcon className="shrink-0 h-6 w-6 stroke-2" />
                            {interlinkItem.name}
                        </a>
                    ))}
                </div>
            </div>
        )}
    </>
);
