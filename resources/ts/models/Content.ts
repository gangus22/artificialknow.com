export type Content = {
    id: number;
    name: string;
    article: Chapter[];
    created_at: string;
    updated_at: string;
};

export type Chapter = {
    data: ChapterData;
};

export type ChapterData = {
    title: string;
    slug: string;
    parts: Component[];
};

export type Component = {
    type: string;
    data: { id: string & any };
};
