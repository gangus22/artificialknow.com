import React from "react";

export const PageFooter: React.FC = () => (
    <div className="sticky top-full bottom-0 flex h-12 w-screen items-center justify-between bg-slate-800 px-4 text-slate-300">
        <div>ArtificialKnow, 2023</div>
        <a className="underline" href="/about-us">
            About Us
        </a>
    </div>
);
