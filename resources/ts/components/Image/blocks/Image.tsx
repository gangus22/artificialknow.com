import React from "react";

export const Image: React.FC<{ url: string; alt: string }> = ({ url, alt }) => (
    <img alt={alt} src={url} />
);
