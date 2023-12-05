import React from "react";
import { Link } from "react-scroll";
import { ChevronRightIcon } from "@heroicons/react/24/outline";
import { Chapter } from "../../../models/Content";

export const TableOfContents: React.FC<{
    chapters: Chapter[];
}> = ({ chapters }) => (
    <div className="sticky top-32 flex h-max flex-col gap-y-4 rounded-lg p-5 bg-primary-50">
        <span className="text-2xl font-bold">Table Of Contents</span>
        <div className="flex flex-col gap-x-8 gap-y-2 text-lg font-normal">
            {chapters.map((chapter) => (
                <div className="flex items-center" key={chapter.data.slug}>
                    <ChevronRightIcon className="h-4 w-4 stroke-2" />
                    <Link
                        className="cursor-pointer truncate text-slate-600 hover:text-slate-950 hover:underline"
                        to={chapter.data.slug}
                        offset={-50}
                        duration={400}
                        smooth
                    >
                        {chapter.data.title}
                    </Link>
                </div>
            ))}
        </div>
    </div>
);
