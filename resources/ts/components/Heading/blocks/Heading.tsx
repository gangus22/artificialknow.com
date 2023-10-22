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
                level === 1 && "text-5xl",
                level === 2 && "text-3xl",
                level === 3 && "text-2xl",
                level === 4 && "text-xl"
            )}
        >
            {text}
        </HeadingTag>
    );
};
