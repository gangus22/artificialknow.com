import React from "react";
import { InputFieldProps } from "../types/InputFieldProps";

export const InputField: React.FC<InputFieldProps> = (props) => {
    const { name, type, placeholder, className } = props;
    return (
        <input
            name={name}
            type={type}
            className={
                className ??
                "w-full rounded-2xl border-2 border-slate-900 bg-slate-300"
            }
            placeholder={placeholder}
            autoComplete=""
        />
    );
};
