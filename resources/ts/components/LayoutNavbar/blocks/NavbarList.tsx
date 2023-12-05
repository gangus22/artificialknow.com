import React from "react";
import { NavbarItem } from "../types/NavbarItem";
import { GenericListItem } from "../../MainPageListItem/blocks/GenericListItem";

export const NavbarList: React.FC<{
    selectedUrlList: NavbarItem;
}> = ({ selectedUrlList }) => (
    <div className="flex flex-col gap-y-4 absolute top-24 z-50 w-max h-max right-0 p-4 bg-white text-slate-600 text-lg font-semibold !list-none leading-loose p-x-2">
        {selectedUrlList.urls.map((item) => (
            <GenericListItem href={item.url} text={item.name} key={item.url} />
        ))}
    </div>
);
