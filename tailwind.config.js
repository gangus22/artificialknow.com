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
            primary: colors.green,
            secondary: colors.sky,
            orange: colors.orange,
            slate: colors.slate,
            cyan: colors.cyan,
            white: colors.white,
            red: colors.red,
            transparent: colors.transparent,
        },
        fontFamily: {
            domine: ["Domine", "sans-serif"],
            sans: ["Manrope", "sans-serif"],
            serif: ["Graphik", "serif"],
        },
        extend: {},
    },
    plugins: [
        require("@tailwindcss/forms"),
        plugin(function ({ addVariant }) {
            addVariant("second-to-last-of-type", "&:nth-last-of-type(2)");
        }),
    ],
};
