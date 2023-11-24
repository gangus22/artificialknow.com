import React from "react";
import classNames from "classnames";

export const Heading: React.FC<{ text: string; level: number }> = ({
    text,
    level,
}) => {
    const HeadingTag = `h${level}` as keyof React.JSX.IntrinsicElements;

    return (
        <HeadingTag
            className={classNames(
                "font-sans font-black",
                level === 2 && "text-2xl md:text-3xl my-8",
                level === 3 && "text-xl md:text-2xl my-4",
                level === 4 && "text-lg md:text-xl my-2"
            )}
        >
            {text}
        </HeadingTag>
    );
};
