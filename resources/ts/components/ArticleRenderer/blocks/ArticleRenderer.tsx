import React from "react";
import { ArticlePart } from "../../../modelTypes/Content";
import { useComponentMap } from "../hooks/useComponentMap";

export const ArticleRenderer: React.FC<{ articleJson: ArticlePart[] }> = ({
    articleJson,
}) => {
    const { componentMap } = useComponentMap();
    return (
        <>
            {articleJson.map((part, key) => {
                const ComponentFromMap = componentMap[part.type];
                // TODO: article layout won't change between renders, but add unique slugs bc they are also required for a TOC
                // eslint-disable-next-line react/no-array-index-key
                return <ComponentFromMap key={key} {...part.data} />;
            })}
        </>
    );
};
