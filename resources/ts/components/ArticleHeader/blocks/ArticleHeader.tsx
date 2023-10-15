import React from "react";
import { ArticleInfoRow } from "./ArticleInfoRow";
import { Heading } from "../../Heading/blocks/Heading";

export const ArticleHeader: React.FC<{ text: string }> = ({ text }) => (
    <div className="mt-4 mb-8 flex flex-col gap-y-4 border-b-2 border-dotted border-slate-300 pb-8">
        <Heading level={1} text={text} />
        <ArticleInfoRow />
    </div>
);
