import colors from 'tailwindcss/colors'

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/views/**/**/*.blade.php',
    ],

    theme: {

        extend: {
            colors: {
                transparent: 'transparent',
                'primary': {
                    DEFAULT: colors.orange["500"],
                    hover: colors.orange["600"]
                }
            },
            fontFamily: {
                'mont': ["Montserrat", "serif"],
                'open-sans': ["Open Sans", "sans-serif"],
                'inter': ["Inter", "sans-serif"],
            },
        },
    },

    plugins: [],
};
