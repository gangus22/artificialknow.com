import { CalendarIcon, UserCircleIcon } from "@heroicons/react/24/outline";
import React from "react";

export const ArticleInfoRow: React.FC = () => (
    <div className="flex gap-x-4">
        <span className="flex items-center gap-x-1 text-sm font-bold text-slate-600">
            <UserCircleIcon className="h-8 w-8 stroke-slate-600" />
            Author
        </span>
        <span className="flex items-center gap-x-1 text-sm font-bold text-slate-600">
            <CalendarIcon className="h-8 w-8 stroke-slate-600" />
            Date
        </span>
    </div>
);
