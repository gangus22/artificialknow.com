import React from "react";

export const MainPageListitem: React.FC<{
    href: string;
    text: string;
}> = ({ href, text }) => (
    <li>
        <a className="hover:underline hover:text-secondary-400" href={href}>
            {text}
        </a>
    </li>
);
