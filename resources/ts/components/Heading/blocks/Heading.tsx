import React from "react";

export const Heading: React.FC<{ text: string; level: number }> = ({
    text,
    level,
}) => {
    const HeadingTag = `h${level}` as keyof React.JSX.IntrinsicElements;

    return (
        <HeadingTag className="font-sans text-5xl font-black">
            {text}
        </HeadingTag>
    );
};
