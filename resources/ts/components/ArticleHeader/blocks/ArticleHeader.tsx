import React from "react";
import { AuthorInfo } from "./AuthorInfo";
import { Heading } from "../../Heading/blocks/Heading";
import { PublishInfo } from "./PublishInfo";

export const ArticleHeader: React.FC<{ text: string }> = ({ text }) => (
    <div className="mb-4 flex flex-col gap-y-4 border-b-2 border-dotted border-slate-300 pb-8">
        <Heading level={1} text={text} />
        <div className="flex items-center gap-x-4 md:gap-x-8 text-sm font-bold text-slate-600">
            <AuthorInfo />
            <PublishInfo />
        </div>
    </div>
);
