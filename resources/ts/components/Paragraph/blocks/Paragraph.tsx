import React from "react";

export const Paragraph: React.FC<{ htmlContent: string }> = ({
    htmlContent,
}) => (
    // eslint-disable-next-line react/no-danger
    <div
        className="leading-loose"
        dangerouslySetInnerHTML={{ __html: htmlContent }}
    />
);
0;
