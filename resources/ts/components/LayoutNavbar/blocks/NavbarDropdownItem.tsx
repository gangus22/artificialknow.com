import React from "react";
import { ChevronDownIcon } from "@heroicons/react/24/outline";
import { NavbarDropdownItemProps } from "../types/NavbarDropdownItemProps";

export const NavbarDropdownItem: React.FunctionComponent<
    NavbarDropdownItemProps
> = ({ item, isOpen, onClickHandler }) => (
    <button
        type="button"
        className="cursor-pointer p-4 group"
        onClick={() => onClickHandler()}
    >
        <div className="relative flex items-center gap-x-1">
            <div className="shrink-0 transition-colors group-hover:text-primary-600 group-hover:underline">
                {item.name}
            </div>
            <ChevronDownIcon className="h-3 w-3 stroke-2 transition-[stroke] group-hover:stroke-primary-500" />
            {isOpen && (
                <div className="absolute top-3/4 mt-8 box-content w-max flex-col p-4 text-left !text-base rounded-blur-box cursor-auto">
                    {/* TODO: format urls when there's content to link to */}
                    {item.urls.map((navbarUrl) => (
                        <div key={navbarUrl}>{navbarUrl}</div>
                    ))}
                </div>
            )}
        </div>
    </button>
);
