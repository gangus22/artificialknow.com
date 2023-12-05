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
import { InterlinkList } from "../components/InterlinkList/blocks/InterlinkList";
import { BreadcrumbsItem } from "../components/Breadcrumbs/types/BreadcrumbsItem";
import { InterlinkItem } from "../components/InterlinkList/types/InterlinkItem";
import { ArticleSchemaMarkup } from "../components/ArticleSchemaMarkup/blocks/ArticleSchemaMarkup";
import { TableOfContents } from "../components/TableOfContents/blocks/TableOfContents";

export const ArticlePage: React.FC<{
    page: Page;
    author: Author;
    breadcrumbs: BreadcrumbsItem[];
    interlinkedUrls: InterlinkItem[];
}> = ({ page, author, breadcrumbs, interlinkedUrls }) => (
    <PageWrapper page={page}>
        <div className="flex gap-x-10">
            <AsideWrapper>
                <TableOfContents chapters={page.content.article} />
            </AsideWrapper>
            <ArticleWrapper author={author}>
                <ArticleSchemaMarkup />
                <Breadcrumbs breadcrumbs={breadcrumbs} />
                <ArticleHeader text={page.title_tag} />
                <ArticleInfoRow />
                <DottedDivider />
                <ChapterRenderer chapters={page.content.article} />
                <InterlinkList interlinks={interlinkedUrls} />
            </ArticleWrapper>
        </div>
    </PageWrapper>
);

export default memo(ArticlePage);
