import React, { useContext } from "react";
import { Head } from "@inertiajs/react";
import { jsonLdScriptProps } from "react-schemaorg";
import { Article } from "schema-dts";
import { PageContext } from "../../../contexts/PageContext";
import { AuthorContext } from "../../../contexts/AuthorContext";

export const ArticleSchemaMarkup: React.FC = () => {
    const page = useContext(PageContext)!;
    const author = useContext(AuthorContext)!;
    return (
        <Head>
            <script
                {...jsonLdScriptProps<Article>({
                    "@context": "https://schema.org",
                    "@type": "Article",
                    headline: page.title_tag,
                    // TODO: add default site image, to meta data as well
                    // image: [
                    //     "https://example.com/photos/1x1/photo.jpg",
                    //     "https://example.com/photos/4x3/photo.jpg",
                    //     "https://example.com/photos/16x9/photo.jpg",
                    // ],
                    datePublished: page.created_at,
                    dateModified: page.content.updated_at,
                    author: [
                        {
                            "@type": "Person",
                            name: author.name,
                        },
                    ],
                })}
            />
        </Head>
    );
};
