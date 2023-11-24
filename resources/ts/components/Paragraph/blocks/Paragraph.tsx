import React from "react";

export const Paragraph: React.FC<{ htmlContent: string }> = ({
    htmlContent,
}) => (
    <div
        className="leading-loose"
        // eslint-disable-next-line react/no-danger
        dangerouslySetInnerHTML={{ __html: htmlContent }}
    />
);
