import React from "react";

export const Paragraph: React.FC<{ htmlContent: string }> = ({
    htmlContent,
}) => (
    <div
        className="leading-loose [&>blockquote]:ps-2 [&>p>a]:text-secondary-400 [&>p>a]:hover:text-secondary-600 [&>ol]:list-inside [&>ul]:list-inside [&>ul]:list-disc [&>ol]:list-decimal [&>blockquote]:border-l-2 [&>blockquote]:border-slate-200 [&>blockquote]:text-slate-600 [&>p>a]:hover:underline"
        // eslint-disable-next-line react/no-danger
        dangerouslySetInnerHTML={{ __html: htmlContent }}
    />
);
