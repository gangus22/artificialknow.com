import React from "react";

export const ArticleHeader: React.FC<{ text: string }> = ({ text }) => (
    <h1 className="font-sans font-black text-3xl md:text-5xl !leading-tight">
        {text}
    </h1>
);
