import React from "react";

export const Image: React.FC<{ url: string; alt: string }> = ({ url, alt }) => (
    <img className="my-4" alt={alt} src={`/${url}`} />
);
