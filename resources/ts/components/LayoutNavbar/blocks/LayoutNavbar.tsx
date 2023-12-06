import React from "react";
import { Bars3Icon } from "@heroicons/react/24/outline";
import { NavbarItem } from "../types/NavbarItem";
import { NavbarButton } from "./NavbarButton";
import { NavbarScreenOverlay } from "./NavbarScreenOverlay";
import { useNavbar } from "../hooks/useNavbar";
import { SiteLogo } from "./SiteLogo";
import { NavbarList } from "./NavbarList";
import { MobileNavbarList } from "./MobileNavbarList";

const navbarData: NavbarItem[] = [
    {
        name: "AI Tools",
        urls: [
            {
                name: "ChatGPT Guides",
                url: "https://artificialknow.com/ai-tools/chatgpt",
            },
            {
                name: "DeepL Guides",
                url: "https://artificialknow.com/ai-tools/deepl",
            },
            {
                name: "Midjourney Guides",
                url: "https://artificialknow.com/ai-tools/midjourney",
            },
        ],
    },
    {
        name: "Tutorials",
        urls: [
            {
                name: "Mastering content generation with ChatGPT",
                url: "https://artificialknow.com/ai-tools/chatgpt/mastering-content-generation",
            },
            {
                name: "Effortless translation with DeepL: A quick tutorial",
                url: "https://artificialknow.com/ai-tools/deepl/easy-translation-with-deepl",
            },
            {
                name: "Unleashing visual artistry with Midjourney",
                url: "https://artificialknow.com/ai-tools/midjourney/creative-image-generation",
            },
        ],
    },
];

export const LayoutNavbar: React.FC = () => {
    const {
        openedIndex,
        isMobileNavOpened,
        toggleOpened,
        toggleMobileNav,
        clearOpened,
        clearMobileNav,
    } = useNavbar();
    return (
        <div className="sticky top-0 z-50 bg-white">
            <div className="container relative mx-auto flex h-24 items-center justify-between p-2 py-5">
                <SiteLogo />
                <div className="hidden items-center gap-x-8 py-2 font-sans text-lg font-bold md:flex">
                    {navbarData.map((item, index) => (
                        <NavbarButton
                            key={item.name}
                            item={item}
                            isOpen={openedIndex === index}
                            onClickHandler={() => toggleOpened(index)}
                        />
                    ))}
                </div>
                {openedIndex !== undefined && (
                    <>
                        <NavbarList selectedUrlList={navbarData[openedIndex]} />
                        <NavbarScreenOverlay onClickHandler={clearOpened} />
                    </>
                )}
                <div className="md:hidden">
                    <Bars3Icon
                        className="h-10 w-10 md:hidden"
                        onClick={toggleMobileNav}
                    />
                    {isMobileNavOpened && (
                        <>
                            <MobileNavbarList items={navbarData} />
                            <NavbarScreenOverlay
                                onClickHandler={clearMobileNav}
                            />
                        </>
                    )}
                </div>
            </div>
        </div>
    );
};
