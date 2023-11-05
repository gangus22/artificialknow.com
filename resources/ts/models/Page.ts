import { Cluster } from "./Cluster";
import { Content } from "./Content";

export type Page = {
    id: number;
    path: string;
    url: string;
    title_tag: string;
    cluster: Cluster;
    content: Content;
};
