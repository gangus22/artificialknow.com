import { Cluster } from "./Cluster";
import { Content } from "./Content";

export type Page = {
    id: number;
    path: string;
    url: string;
    meta: MetaData;
    title_tag: string;
    cluster: Cluster;
    content: Content;
    created_at: string;
    updated_at: string;
};

type MetaData = {
    metaDescription: string;
    "og:title": string;
    "og:description": string;
    "og:image": string;
};
