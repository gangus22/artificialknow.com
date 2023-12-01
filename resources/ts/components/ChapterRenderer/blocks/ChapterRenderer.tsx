import React from "react";
import { Chapter as ChapterType } from "../../../models/Content";
import { Chapter } from "./Chapter";

export const ChapterRenderer: React.FC<{ chapters: ChapterType[] }> = ({
    chapters,
}) => (
    <>
        {chapters.map((chapter) => (
            <Chapter chapterData={chapter.data} key={chapter.data.slug} />
        ))}
    </>
);
