import React from "react";
import { AuthorInfo } from "./AuthorInfo";
import { PublishInfo } from "./PublishInfo";

export const ArticleHeader: React.FC<{ text: string }> = ({ text }) => (
    <div className="mb-4 flex flex-col gap-y-4 border-b-2 border-dotted border-slate-300 pb-8">
        <h1 className="font-sans font-black text-3xl md:text-5xl !leading-tight">
            {text}
        </h1>
        <div className="flex items-center gap-x-4 text-sm font-bold text-slate-600 md:gap-x-8">
            <AuthorInfo />
            <PublishInfo />
        </div>
    </div>
);
