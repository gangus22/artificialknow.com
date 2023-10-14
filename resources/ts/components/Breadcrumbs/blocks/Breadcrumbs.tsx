import React from "react";

export const Breadcrumbs: React.FC<{ url: string }> = ({ url }) => (
    <div className="w-max rounded-full px-4 py-2 text-sm bg-secondary-100">
        {url.replace("/", " / ")}
    </div>
);
