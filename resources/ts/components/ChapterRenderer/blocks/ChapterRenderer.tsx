import React from "react";
import { Chapter as ChapterType } from "../../../models/Content";
import { Chapter } from "./Chapter";

export const ChapterRenderer: React.FC<{ chapters: ChapterType[] }> = ({
    chapters,
}) => (
    <>
        {chapters.map((chapter, key) => (
            // eslint-disable-next-line react/no-array-index-key
            <Chapter chapterData={chapter.data} key={key} />
        ))}
    </>
);
