import React, { useState } from "react";
import { Bars3Icon } from "@heroicons/react/24/outline";
import { NavbarItem } from "../types/NavbarItem";
import { NavbarDropdownItem } from "./NavbarDropdownItem";
import { NavbarScreenOverlay } from "./NavbarScreenOverlay";

const testData: NavbarItem[] = [
    {
        name: "AI Tools",
        urls: ["Click this for some cool stuff!", "More cool stuff here!"],
    },
    {
        name: "Tutorials",
        urls: ["Tutorials galore", "One two three four"],
    },
    {
        name: "About Us",
        urls: ["something"],
    },
];

// TODO: add button component
// TODO: make a service that returns the navbar layout
// TODO: try and extract component logic into a separate hook
// TODO: click outside logic with window.something
export const LayoutNavbar: React.FC = () => {
    const [openedIndex, setOpenedIndex] = useState<number | undefined>(
        undefined
    );
    const toggleOpened = (index: number) => {
        if (openedIndex === index) {
            setOpenedIndex(undefined);
        } else {
            setOpenedIndex(index);
        }
    };
    const clearOpened = () => setOpenedIndex(undefined);

    return (
        <div className="sticky top-0 md:top-4">
            <div className="mb-10 flex items-center justify-between border-b px-2 py-2 bg-secondary-200 three-d border-slate-950 md:border md:py-0">
                <div>LOGO</div>
                <Bars3Icon className="h-10 w-10 md:hidden" />
                <div className="hidden items-center gap-x-8 text-xl font-bold font-domine md:flex">
                    {testData.map((item, index) => (
                        <NavbarDropdownItem
                            key={item.name}
                            item={item}
                            isOpen={openedIndex === index}
                            onClickHandler={() => toggleOpened(index)}
                        />
                    ))}
                </div>
                {openedIndex !== undefined && (
                    <NavbarScreenOverlay onClickHandler={clearOpened} />
                )}
            </div>
        </div>
    );
};
