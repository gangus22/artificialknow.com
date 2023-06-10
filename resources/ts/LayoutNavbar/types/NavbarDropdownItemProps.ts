import { NavbarItem } from "./NavbarItem";

export type NavbarDropdownItemProps = {
    item: NavbarItem;
    isOpen: boolean;
    onClickHandler: () => void;
};
