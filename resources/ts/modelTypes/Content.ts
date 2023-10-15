export type Content = {
    id: number;
    name: string;
    article: ArticlePart[];
};

export type ArticlePart = {
    type: string;
    data: Array<any>;
};
