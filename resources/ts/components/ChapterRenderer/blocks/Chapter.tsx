import React from "react";
import { Element } from "react-scroll";
import { Heading } from "../../Heading/blocks/Heading";
import { ChapterData } from "../../../models/Content";
import { useComponentMap } from "../hooks/useComponentMap";

export const Chapter: React.FC<{ chapterData: ChapterData }> = ({
    chapterData,
}) => {
    const { componentMap } = useComponentMap();
    return (
        <>
            <Element name={chapterData.slug} />
            <Heading
                level={2}
                text={chapterData.title}
                key={chapterData.slug}
            />
            {chapterData.parts.map((component) => {
                const ComponentFromMap = componentMap[component.type];
                return (
                    <ComponentFromMap key={component.id} {...component.data} />
                );
            })}
        </>
    );
};
