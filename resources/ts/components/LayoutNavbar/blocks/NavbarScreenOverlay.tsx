import React from "react";
import { NavbarScreenOverlayProps } from "../types/NavbarScreenOverlayProps";

export const NavbarScreenOverlay: React.FunctionComponent<
    NavbarScreenOverlayProps
> = ({ onClickHandler }) => (
    <div
        className="absolute top-14 left-0 h-screen w-full"
        onClick={onClickHandler}
    />
);
