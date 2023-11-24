import React from "react";

export const ArticleHeader: React.FC<{ text: string }> = ({ text }) => (
    <h1 className="font-sans font-black text-2xl md:text-4xl !leading-tight">
        {text}
    </h1>
);
