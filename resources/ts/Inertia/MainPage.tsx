import React, { memo } from "react";
import { PageWrapper } from "../components/PageWrapper/blocks/PageWrapper";
import { Page } from "../models/Page";

export const MainPage: React.FC<{ page: Page }> = ({ page }) => (
    <PageWrapper page={page}>
        <div> Main Page Placeholder</div>
    </PageWrapper>
);

export default memo(MainPage);
