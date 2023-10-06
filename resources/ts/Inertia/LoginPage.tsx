import React, { memo } from "react";
import { LoginForm } from "../components/LoginForm/blocks/LoginForm";

export const LoginPage: React.FC = () => (
    <div className="flex h-screen w-screen flex-col items-center justify-center bg-gradient-to-bl from-slate-800 from-50% to-secondary-900">
        <LoginForm />
    </div>
);
export default memo(LoginPage);
