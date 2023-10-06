import { CalendarIcon, UserCircleIcon } from "@heroicons/react/24/outline";
import React from "react";

export const ArticleInfoRow: React.FC = () => (
    <div className="flex items-center gap-x-2 text-sm font-bold text-slate-600">
        <UserCircleIcon className="h-8 w-8 stroke-slate-600" />
        Author
        <CalendarIcon className="h-8 w-8 stroke-slate-600" />
        Date
    </div>
);
