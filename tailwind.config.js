const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'wc-lightest': '#eeeee4',
                'wc-lighter': '#c29967',
                'wc-light': '#d29e6c',
                'wc': '#1AA0B3',
                'wc-dark': '#d1785f', //'#8a1538',
                'wc-darker': '#9f3043', //'#56042C',
                'wc-darkest': '#982043', //'#3d0918',
            },
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
