import React from "react";
import { Heading } from "../../Heading/blocks/Heading";
import { ChapterData } from "../../../models/Content";
import { useComponentMap } from "../hooks/useComponentMap";

export const Chapter: React.FC<{ chapterData: ChapterData }> = ({
    chapterData,
}) => {
    const { componentMap } = useComponentMap();
    return (
        <>
            <Heading
                level={2}
                text={chapterData.title}
                key={chapterData.slug}
            />
            {chapterData.parts.map((component, key) => {
                const ComponentFromMap = componentMap[component.type];
                // eslint-disable-next-line react/no-array-index-key
                return <ComponentFromMap key={key} {...component.data} />;
            })}
        </>
    );
};
