import { createContext } from "react";
import { Page } from "../models/Page";

export const PageContext = createContext<Page | undefined>(undefined);
