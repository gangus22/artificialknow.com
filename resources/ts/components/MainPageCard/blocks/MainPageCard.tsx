import React, { ReactNode } from "react";

export const MainPageCard: React.FC<{
    iconComponent: ReactNode;
    text: string;
}> = ({ iconComponent, text }) => (
    <div className="bg-slate-50 w-full md:w-1/4 h-20 rounded-lg p-2">
        <div className="w-full h-full flex gap-x-5 justify-between items-center">
            {iconComponent}
            <div className="font-semibold text-md text-right">{text}</div>
        </div>
    </div>
);
