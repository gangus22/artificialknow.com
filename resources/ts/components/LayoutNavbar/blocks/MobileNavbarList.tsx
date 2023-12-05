import React, { Fragment } from "react";
import { NavbarItem } from "../types/NavbarItem";
import { GenericListItem } from "../../MainPageListItem/blocks/GenericListItem";

export const MobileNavbarList: React.FC<{
    items: NavbarItem[];
}> = ({ items }) => (
    <div className="flex flex-col max-h-96 gap-y-4 max-w-full absolute top-24 z-50 h-max left-0 p-4 bg-white text-slate-600 text-lg font-semibold !list-none p-x-2">
        {items.map((item) => (
            <Fragment key={item.name}>
                <div> {item.name} </div>
                <div className="leading-loose text-slate-950 text-base">
                    {item.urls.map((urlItem) => (
                        <GenericListItem
                            href={urlItem.url}
                            text={urlItem.name}
                            key={urlItem.url}
                        />
                    ))}
                </div>
            </Fragment>
        ))}
    </div>
);
