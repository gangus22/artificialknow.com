import React, { PropsWithChildren } from "react";
import { AuthorContext } from "../../../contexts/AuthorContext";
import { Author } from "../../../models/Author";

export const ArticleWrapper: React.FC<
    PropsWithChildren<{ author: Author }>
> = ({ author, children }) => (
    <article className="flex flex-col gap-y-4 bg-white p-5 pt-0 text-lg md:w-2/3">
        <AuthorContext.Provider value={author}>
            {children}
        </AuthorContext.Provider>
    </article>
);
