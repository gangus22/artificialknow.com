import { createContext } from "react";
import { Author } from "../models/Author";

export const AuthorContext = createContext<Author | null>(null);
