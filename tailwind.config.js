/** @type {import('tailwindcss').Config} */
const withMT = require("@material-tailwind/html/utils/withMT");

module.exports = withMT({
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./node_modules/flowbite/**/*.js",
        "./node_modules/chart.js/**/*.js",
        "./node_modules/preline/dist/*.js",
    ],
    theme: {
        extend: {
            screens: {
                "2md": "1060px",
            },
        },
    },
    plugins: [require("flowbite/plugin"), require("preline/plugin")],
});
