const plugin = require("tailwindcss/plugin");
/** @type {DefaultColors} */
const colors = require("tailwindcss/colors");

module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.ts",
        "./resources/**/*.tsx",
    ],
    theme: {
        colors: {
            primary: colors.emerald,
            secondary: colors.indigo,
            slate: colors.slate,
            cyan: colors.cyan,
            white: colors.white,
            red: colors.red,
        },
        fontFamily: {
            sans: ["Sora", "sans-serif"],
            serif: ["Graphik", "serif"],
        },
        extend: {},
    },
    plugins: [require("@tailwindcss/forms")],
};
