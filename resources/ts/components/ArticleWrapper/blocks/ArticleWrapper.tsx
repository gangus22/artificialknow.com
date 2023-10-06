import React, { PropsWithChildren } from "react";

export const ArticleWrapper: React.FC<PropsWithChildren> = ({ children }) => (
    <article className="flex flex-col gap-y-4 bg-white p-5 pt-0 text-lg md:w-2/3">
        {children}
    </article>
);
