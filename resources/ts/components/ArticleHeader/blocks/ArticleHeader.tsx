import React from "react";
import { H1 } from "../../H1/blocks/H1";
import { ArticleInfoRow } from "./ArticleInfoRow";

export const ArticleHeader: React.FC<{ text: string }> = ({ text }) => (
    <div className="mt-4 mb-8 flex flex-col gap-y-4 border-b-2 border-dotted border-slate-300 pb-8">
        <H1>{text}</H1>
        <ArticleInfoRow />
    </div>
);
