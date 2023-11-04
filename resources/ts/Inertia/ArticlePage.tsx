import React, { memo } from "react";
import { PageWrapper } from "../components/PageWrapper/blocks/PageWrapper";
import { ArticleWrapper } from "../components/ArticleWrapper/blocks/ArticleWrapper";
import { AsideWrapper } from "../components/AsideWrapper/blocks/AsideWrapper";
import { Breadcrumbs } from "../components/Breadcrumbs/blocks/Breadcrumbs";
import { ArticleHeader } from "../components/ArticleHeader/blocks/ArticleHeader";
import { Page } from "../models/Page";
import { ChapterRenderer } from "../components/ChapterRenderer/blocks/ChapterRenderer";
import { Author } from "../models/Author";
import { ArticleInfoRow } from "../components/ArticleInfoRow/blocks/ArticleInfoRow";
import { DottedDivider } from "../components/DottedDivider/blocks/DottedDivider";

export const ArticlePage: React.FC<{ page: Page; author: Author }> = ({
    page,
    author,
}) => (
    <PageWrapper page={page}>
        <div className="flex gap-x-10">
            <AsideWrapper>
                <div className="sticky top-32 h-max rounded-lg p-5 bg-primary-100">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Fugit, iure, voluptate. Accusantium distinctio fugit magnam
                    nobis tenetur? Ad aliquid amet commodi consectetur
                    cupiditate dolorem modi soluta tempora tempore temporibus.
                    Doloremque?
                </div>
            </AsideWrapper>
            <ArticleWrapper author={author}>
                <Breadcrumbs url={page.url} />
                <ArticleHeader text={page.meta.titleTag} />
                <ArticleInfoRow />
                <DottedDivider />
                <ChapterRenderer chapters={page.content.article} />
            </ArticleWrapper>
        </div>
    </PageWrapper>
);

export default memo(ArticlePage);
