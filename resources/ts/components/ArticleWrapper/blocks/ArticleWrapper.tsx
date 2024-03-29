import React, { PropsWithChildren } from "react";
import { AuthorContext } from "../../../contexts/AuthorContext";
import { Author } from "../../../models/Author";

export const ArticleWrapper: React.FC<
    PropsWithChildren<{ author: Author }>
> = ({ author, children }) => (
    <article className="flex flex-col gap-y-4 bg-white text-lg md:w-2/3 w-full">
        <AuthorContext.Provider value={author}>
            {children}
        </AuthorContext.Provider>
    </article>
);
