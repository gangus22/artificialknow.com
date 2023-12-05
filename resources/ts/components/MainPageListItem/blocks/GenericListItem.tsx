import React from "react";

export const GenericListItem: React.FC<{
    href: string;
    text: string;
}> = ({ href, text }) => (
    <li className="truncate">
        <a className="hover:underline hover:text-secondary-400" href={href}>
            {text}
        </a>
    </li>
);
