import { Cluster } from "./Cluster";
import { Content } from "./Content";

// TODO: move title tag onto page model
export type Page = {
    id: number;
    path: string;
    slug: string;
    url: string;
    meta: { titleTag: string };
    cluster: Cluster;
    content: Content;
};
