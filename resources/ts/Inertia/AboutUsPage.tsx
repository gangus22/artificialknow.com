import React, { memo } from "react";
import { QuestionMarkCircleIcon } from "@heroicons/react/24/outline";
import { PageWrapper } from "../components/PageWrapper/blocks/PageWrapper";
import { ArticleHeader } from "../components/ArticleHeader/blocks/ArticleHeader";
import { DottedDivider } from "../components/DottedDivider/blocks/DottedDivider";

export const AboutUsPage: React.FC = () => (
    <PageWrapper>
        <ArticleHeader text="About Us" />
        <DottedDivider />
        <div className="flex justify-between text-xl leading-loose">
            <div className="flex flex-col gap-y-8 md:w-1/3">
                <div>
                    <strong>ArtificialKnow</strong> is an{" "}
                    <strong>artificial intelligence themed blog </strong>
                    made as a student thesis project.
                </div>
                <div>
                    Please enjoy our articles related to artificial
                    intelligence, mainly guides focused on getting the most out
                    of your AI tools.
                </div>
                <div>
                    I wanted to try my hand at making a RILT stack application
                    with SSR from scratch.
                </div>
            </div>
            <QuestionMarkCircleIcon className="hidden h-96 w-96 stroke-primary-300 md:block" />
        </div>
    </PageWrapper>
);

export default memo(AboutUsPage);
