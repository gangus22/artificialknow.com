import React from "react";
import { Head } from "@inertiajs/react";
import { jsonLdScriptProps } from "react-schemaorg";
import { Organization } from "schema-dts";

export const OrganizationSchemaMarkup: React.FC = () => (
    <Head>
        <script
            {...jsonLdScriptProps<Organization>({
                "@context": "https://schema.org",
                "@type": "Organization",
                name: "ArtificialKnow",
                url: "https://www.artificialknow.com",
                logo: "https://www.artificialknow.com/favicon.png",
            })}
        />
    </Head>
);
