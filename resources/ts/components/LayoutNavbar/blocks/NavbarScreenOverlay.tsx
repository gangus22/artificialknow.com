import React from "react";
import { NavbarScreenOverlayProps } from "../types/NavbarScreenOverlayProps";

export const NavbarScreenOverlay: React.FunctionComponent<
    NavbarScreenOverlayProps
> = ({ onClickHandler }) => (
    <div
        className="absolute top-24 left-0 h-screen w-full bg-slate-100/50 md:bg-transparent"
        onClick={onClickHandler}
    />
);
