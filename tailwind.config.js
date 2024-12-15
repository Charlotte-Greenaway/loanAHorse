import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    softwhite: "#f9fafb", // Soft white (previously bg-gray-50)
                    lightgray: "#4b5563", // Light gray (previously text-gray-600)
                    sage: "#98A869", // Muted sage green (previously text-green-700, bg-green-700)
                    darksage: "#505C45", // Darker sage green (previously hover:bg-green-800)
                },
                secondary: {
                    DEFAULT: "#000000", // Black for text and legibility
                },
                accent: {
                    tan: "#d2b48c", // Soft tan (not used in the header, but mentioned in the color scheme)
                },
            },
        },
    },
    plugins: [],
};
