import React from "react";
import { jsonLdScriptProps } from "react-schemaorg";
import { BreadcrumbList } from "schema-dts";
import { Head } from "@inertiajs/react";
import { BreadcrumbsItem } from "../types/BreadcrumbsItem";

export const BreadcrumbListSchemaMarkup: React.FC<{
    breadcrumbs: BreadcrumbsItem[];
}> = ({ breadcrumbs }) => (
    <Head>
        <script
            {...jsonLdScriptProps<BreadcrumbList>({
                "@context": "https://schema.org",
                "@type": "BreadcrumbList",
                itemListElement: breadcrumbs.map((item, index) => ({
                    "@type": "ListItem",
                    position: index + 1,
                    name: item.name,
                    item: item.url,
                })),
            })}
        />
    </Head>
);
