import React from "react";
import { Bars3Icon } from "@heroicons/react/24/outline";
import { NavbarItem } from "../types/NavbarItem";
import { NavbarDropdownItem } from "./NavbarDropdownItem";
import { NavbarScreenOverlay } from "./NavbarScreenOverlay";
import { useNavbar } from "../hooks/useNavbar";

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
// TODO: click outside logic with a package
export const LayoutNavbar: React.FC = () => {
    const { openedIndex, toggleOpened, clearOpened } = useNavbar();
    return (
        <div className="sticky top-0 z-50 bg-white">
            <div className="container mx-auto flex items-center justify-between p-2 py-5">
                <div>Logo Placeholder</div>
                <Bars3Icon className="h-10 w-10 md:hidden" />
                <div className="hidden items-center gap-x-8 py-2 font-sans text-lg font-bold md:flex">
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
