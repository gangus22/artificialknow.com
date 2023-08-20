import React from "react";
import { InputField } from "../../InputField/parts/InputField";
import { useLogin } from "../hooks/useLogin";

export const LoginForm: React.FC = () => {
    const { attemptLogin } = useLogin();

    return (
        <form
            onSubmit={attemptLogin}
            className="flex flex-col items-center gap-y-8 rounded-2xl border-2 border-slate-900 bg-slate-400 p-5 w-[20%]"
        >
            <InputField type="text" placeholder="Username" name="username" />
            <InputField
                type="password"
                placeholder="Password"
                name="password"
            />
            <InputField
                type="submit"
                className="cursor-pointer rounded-2xl border-2 border-slate-900 p-2 bg-secondary-400"
                name="submit"
            />
        </form>
    );
};
