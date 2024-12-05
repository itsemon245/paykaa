import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

const primaryColors = {
    DEFAULT: 'var(--primary-500)',
    50: 'var(--primary-50)',
    100: 'var(--primary-100)',
    200: 'var(--primary-200)',
    300: 'var(--primary-300)',
    400: 'var(--primary-400)',
    500: 'var(--primary-500)',
    600: 'var(--primary-600)',
    700: 'var(--primary-700)',
    800: 'var(--primary-800)',
    900: 'var(--primary-900)',
};

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.{tsx,jsx,vue,mdx}',
        "./node_modules/primereact/**/*.{js,ts,jsx,tsx}",
    ],

    theme: {
        extend: {
            colors: {
                primary: {
                    ...primaryColors
                },
                blue: {
                    ...primaryColors,
                },
            },
            transitionProperty: {
                'w': 'width'
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
