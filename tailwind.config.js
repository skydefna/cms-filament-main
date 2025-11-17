/** @type {import('tailwindcss').Config} */
const colors = require("tailwindcss/colors.js");
const customColors = {
    "transparent": "transparent",
    "current": "currentColor",
    "black": "#000000",
    "white": "#FFFFFF",
    "theme": colors.gray,
    "background": {
        "light": "transparent",
        "dark": "transparent"
    },
    "gray": {
        "50": "#F4F4F5",
        "100": "#E4E4E7",
        "200": "#D4D4D8",
        "300": "#A1A1AA",
        "400": "#71717A",
        "500": "#52525B",
        "600": "#3F3F46",
        "700": "#27272A",
        "800": "#18181B",
        "900": "#09090B",
        "950": "#09090B"
    },
    "dark": {
        "50": "#F4F4F5",
        "100": "#E4E4E7",
        "200": "#D4D4D8",
        "300": "#A1A1AA",
        "400": "#71717A",
        "500": "#52525B",
        "600": "#3F3F46",
        "700": "#27272A",
        "800": "#18181B",
        "900": "#09090B",
        "950": "#09090B"
    },
    "primary": colors.zinc,
    "secondary": colors.zinc,
    "positive": colors.emerald,
    "negative": colors.rose,
    "warning": colors.amber,
    "info": colors.sky,
    "blue": colors.blue,
    "red" : colors.red,
    "green" : colors.green,
    "yellow" : colors.yellow,
    "pink" : colors.pink,
    "purple" : colors.purple,
    "orange" : colors.orange,
    "cyan" : colors.cyan,
    "teal" : colors.teal,
    "lime" : colors.lime,
    "emerald" : colors.emerald,
    "amber" : colors.amber,
}

module.exports = {
    safelist: [
        'md:grid-cols-1',
        'md:grid-cols-2',
        'md:grid-cols-3',
        'md:grid-cols-4',
        'md:grid-cols-5',
        'md:grid-cols-6',
        'md:grid-cols-7',
        'md:grid-cols-8',
        'md:grid-cols-9',
        'md:grid-cols-10',
        'md:grid-cols-11',
        'md:grid-cols-12',
    ],
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './vendor/awcodes/filament-tiptap-editor/resources/**/*.blade.php',
        './vendor/awcodes/palette/resources/views/**/*.blade.php',
    ],
    theme: {
        container: {
            center: true,
            padding: {
                DEFAULT: '1rem',
                sm: '2rem',
                lg: '3rem',
                xl: '4rem',
                '2xl': '6rem',
            },
        },
        extend: {
            colors: customColors,
            fontFamily: {
                'sans': ['"Poppins", sans-serif'],
                'serif': ['"Space Mono", serif'],
                'mono': ['"Space Mono", serif'],
                'display': ['"Poppins", sans-serif'],
                'body': ['"Poppins",  sans-serif'],
            }
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
        require("@tailwindcss/forms")({
            strategy: 'base',
        }),
    ],
};
