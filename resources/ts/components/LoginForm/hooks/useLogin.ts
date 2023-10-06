import axios from "axios";
import React from "react";

export const useLogin = () => {
    const attemptLogin = (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault();
        const formData = new FormData(e.target as HTMLFormElement);
        axios.get("/sanctum/csrf-cookie").then(() => {
            axios
                .post("login", {
                    username: formData.get("username"),
                    password: formData.get("password"),
                })
                .then((r) => {
                    window.location = r.data.redirect ?? window.location.href;
                });
        });
    };

    return { attemptLogin };
};
