import React, { useContext } from "react";
import { AuthorContext } from "../../../contexts/AuthorContext";

export const AuthorInfo: React.FC = () => {
    const author = useContext(AuthorContext)!;
    return (
        <div className="flex gap-x-2 items-center text-base">
            {author && (
                <img
                    src={`/${author.img_path}`}
                    alt={author.name}
                    className="h-8 w-8 rounded-full"
                />
            )}
            {author.name}
        </div>
    );
};
