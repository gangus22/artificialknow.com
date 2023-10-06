import React from "react";

export type InputFieldProps = {
    name: string;
    type: React.InputHTMLAttributes<HTMLInputElement>["type"];
    placeholder?: string;
    className?: string;
};
