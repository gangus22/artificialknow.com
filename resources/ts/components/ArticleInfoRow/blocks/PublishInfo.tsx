import React, { useContext } from "react";
import { CalendarIcon } from "@heroicons/react/24/outline";
import { PageContext } from "../../../contexts/PageContext";

export const PublishInfo: React.FC = () => {
    const page = useContext(PageContext)!;
    const date = new Date(page.content.updated_at).toLocaleDateString("en-US");
    return (
        <div className="flex gap-x-2 items-center text-base">
            <CalendarIcon className="h-8 w-8 stroke-slate-600" />
            {date}
        </div>
    );
};
