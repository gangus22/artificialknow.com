import { useState } from "react";

export const useNavbar = () => {
    const [openedIndex, setOpenedIndex] = useState<number | undefined>(
        undefined
    );

    const [isMobileNavOpened, setIsMobileNavOpened] = useState<boolean>(false);

    const toggleOpened = (index: number) => {
        if (openedIndex === index) {
            setOpenedIndex(undefined);
        } else {
            setOpenedIndex(index);
        }
    };

    const toggleMobileNav = () => {
        setIsMobileNavOpened((prevState) => !prevState);
    };

    const clearOpened = () => setOpenedIndex(undefined);

    const clearMobileNav = () => setIsMobileNavOpened(false);

    return {
        openedIndex,
        isMobileNavOpened,
        toggleOpened,
        toggleMobileNav,
        clearOpened,
        clearMobileNav,
    };
};
