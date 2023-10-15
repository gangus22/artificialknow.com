import React, { memo } from "react";
import { PageWrapper } from "../components/PageWrapper/blocks/PageWrapper";
import { ArticleWrapper } from "../components/ArticleWrapper/blocks/ArticleWrapper";
import { AsideWrapper } from "../components/AsideWrapper/blocks/AsideWrapper";
import { Breadcrumbs } from "../components/Breadcrumbs/blocks/Breadcrumbs";
import { ArticleHeader } from "../components/ArticleHeader/blocks/ArticleHeader";
import { Page } from "../modelTypes/Page";
import { ArticleRenderer } from "../components/ArticleRenderer/blocks/ArticleRenderer";

export const ArticlePage: React.FC<{ page: Page }> = ({ page }) => (
    <PageWrapper>
        <div className="flex gap-x-10">
            <AsideWrapper>
                <div className="sticky h-max bg-primary-100 top-32 p-5 rounded-lg">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Fugit, iure, voluptate. Accusantium distinctio fugit magnam
                    nobis tenetur? Ad aliquid amet commodi consectetur
                    cupiditate dolorem modi soluta tempora tempore temporibus.
                    Doloremque?
                </div>
            </AsideWrapper>
            <ArticleWrapper>
                <Breadcrumbs url={page.url} />
                <ArticleHeader text={page.meta.titleTag} />
                <ArticleRenderer articleJson={page.content.article} />
            </ArticleWrapper>
        </div>
    </PageWrapper>
);

export default memo(ArticlePage);
