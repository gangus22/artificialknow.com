import React from "react";
import classNames from "classnames";

export const Heading: React.FC<{
    text: string;
    level: number;
    id?: string;
}> = ({ text, level, id }) => {
    const HeadingTag = `h${level}` as keyof React.JSX.IntrinsicElements;

    return (
        <HeadingTag
            id={id}
            className={classNames(
                "font-sans font-black",
                level === 2 && "text-2xl md:text-3xl mb-4 md:mb-8",
                level === 3 && "text-xl md:text-2xl mb-2 md:mb-4",
                level === 4 && "text-lg md:text-xl mb-1 md:mb-2"
            )}
        >
            {text}
        </HeadingTag>
    );
};
