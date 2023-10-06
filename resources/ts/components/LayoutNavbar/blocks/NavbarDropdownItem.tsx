import React from "react";
import { ChevronDownIcon } from "@heroicons/react/24/outline";
import { NavbarDropdownItemProps } from "../types/NavbarDropdownItemProps";

// TODO: make event handler onMouseEnter
// TODO: larger box below, about 1/3 of screen
export const NavbarDropdownItem: React.FunctionComponent<
    NavbarDropdownItemProps
> = ({ item, isOpen, onClickHandler }) => (
    <button
        type="button"
        className="cursor-pointer rounded-full px-4 py-2 transition-colors group bg-primary-100 hover:bg-primary-200"
        onClick={() => onClickHandler()}
    >
        <div className="relative flex items-center gap-x-1">
            <div className="shrink-0 group-hover:text-primary-500">
                {item.name}
            </div>
            <ChevronDownIcon className="h-3 w-3 stroke-[4px] group-hover:stroke-primary-500" />
            {isOpen && (
                <div className="absolute top-8 border-slate-950 rounded-lg border z-50 mt-8 box-content w-max flex-col p-4 text-left !text-base rounded-blur-box cursor-auto">
                    {/* TODO: format urls when there's content to link to */}
                    {item.urls.map((navbarUrl) => (
                        <div key={navbarUrl}>{navbarUrl}</div>
                    ))}
                </div>
            )}
        </div>
    </button>
);
