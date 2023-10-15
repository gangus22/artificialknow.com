import React from "react";
import { Heading } from "../../Heading/blocks/Heading";
import { Paragraph } from "../../Paragraph/blocks/Paragraph";

export const useComponentMap = (): {
    componentMap: { [key: string]: React.FC<any> };
} => ({
        componentMap: {
            heading: Heading,
            paragraph: Paragraph,
        },
    });
