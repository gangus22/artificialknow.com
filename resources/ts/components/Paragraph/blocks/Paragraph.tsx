import React from "react";

export const Paragraph: React.FC<{ htmlContent: string }> = ({
    htmlContent,
}) => (
    // eslint-disable-next-line react/no-danger
    <div dangerouslySetInnerHTML={{ __html: htmlContent }} />
);
