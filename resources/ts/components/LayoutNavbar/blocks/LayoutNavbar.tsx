import React, { useState } from "react";
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
        <div className="rounded-blur-box">
            <div className="sticky top-0 z-10 flex gap-x-8 items-center">
                <div className="justify-self-start">This is a React navbar</div>
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
    );
};
