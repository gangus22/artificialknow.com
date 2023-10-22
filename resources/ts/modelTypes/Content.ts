export type Content = {
    id: number;
    name: string;
    article: Chapter[];
};

export type Chapter = {
    type: "chapter";
    data: ChapterData;
};

export type ChapterData = {
    title: string;
    slug: string;
    parts: Component[];
};

export type Component = {
    type: string;
    data: Array<any>;
};
