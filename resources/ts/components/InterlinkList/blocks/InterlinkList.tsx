import React from "react";
import { InterlinkItem } from "../types/InterlinkItem";

export const InterlinkList: React.FC<{ interlinks: InterlinkItem[] }> = ({
    interlinks,
}) => (
    <>
        {interlinks.map((interlinkItem) => (
            <div key={interlinkItem.url}>{interlinkItem.name}</div>
        ))}
    </>
);
