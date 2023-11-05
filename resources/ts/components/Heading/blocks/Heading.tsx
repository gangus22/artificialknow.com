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
                level === 2 && "text-2xl md:text-3xl",
                level === 3 && "text-xl md:text-2xl",
                level === 4 && "text-lg md:text-xl"
            )}
        >
            {text}
        </HeadingTag>
    );
};
