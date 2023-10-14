import { Cluster } from "./Cluster";
import { Content } from "./Content";

export type Page = {
    id: number;
    path: string;
    slug: string;
    url: string;
    cluster: Cluster;
    content: Content;
};
