import React from "react";
import { AuthorInfo } from "./AuthorInfo";
import { PublishInfo } from "./PublishInfo";

export const ArticleInfoRow: React.FC = () => (
    <div className="flex items-center gap-x-4 text-sm font-bold text-slate-600 md:gap-x-8">
        <AuthorInfo />
        <PublishInfo />
    </div>
);
