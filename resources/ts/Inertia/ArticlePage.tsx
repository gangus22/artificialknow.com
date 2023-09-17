import React, { memo } from "react";
import { PageWrapper } from "../components/PageWrapper/blocks/PageWrapper";

export const ArticlePage: React.FC = () => {
    return (
        <PageWrapper>
            <div className="container mx-auto rounded-2xl bg-white/30 backdrop-blur-sm">
                <div className="flex flex-col items-center gap-y-4 p-5">
                    <div className="rounded-lg border border-slate-700 p-4 bg-primary-400">
                        I'm nice and green, because TailwindCSS works now.
                    </div>
                </div>
            </div>
        </PageWrapper>
    );
};

export default memo(ArticlePage);
