import React from "react";
import { ChevronDownIcon } from "@heroicons/react/24/outline";
import classNames from "classnames";
import { NavbarDropdownItemProps } from "../types/NavbarDropdownItemProps";

export const NavbarButton: React.FunctionComponent<NavbarDropdownItemProps> = ({
    item,
    isOpen,
    onClickHandler,
}) => (
    <button
        type="button"
        className={classNames(
            "cursor-pointer px-4 py-2 group rounded-full hover:bg-primary-50",
            isOpen && "bg-primary-50"
        )}
        onClick={() => onClickHandler()}
    >
        <div className="relative flex items-center gap-x-1">
            <div
                className={classNames(
                    "shrink-0 group-hover:text-primary-500 font-black",
                    isOpen && "text-primary-500"
                )}
            >
                {item.name}
            </div>
            <ChevronDownIcon
                className={classNames(
                    "h-3 w-3 stroke-[4px] group-hover:stroke-primary-500",
                    isOpen && "stroke-primary-500"
                )}
            />
        </div>
    </button>
);
