import { useState } from "react";

export const useNavbar = () => {
    const [openedIndex, setOpenedIndex] = useState<number | undefined>(
        undefined
    );
    const toggleOpened = (index: number) => {
        if (openedIndex === index) {
            setOpenedIndex(undefined);
        } else {
            setOpenedIndex(index);
        }
    };
    const clearOpened = () => setOpenedIndex(undefined);
    return { openedIndex, toggleOpened, clearOpened };
};
