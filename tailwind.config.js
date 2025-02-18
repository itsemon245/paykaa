import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import plugin from 'tailwindcss';

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
            animation: {
                'balloon-up': 'balloon-up 18s linear infinite',
            },
            keyframes: {
                'balloon-up': {
                    '0%': {
                        transform: 'translateY(0px)',
                        rotate: '0deg',
                        opacity: '1',
                        borderRadius: '0px',
                    },
                    '100%': {
                        transform: 'translateY(-1000px)',
                        rotate: '720deg',
                        opacity: '0',
                        borderRadius: '30%',
                    },
                },
            }
        },
    },
    plugins: [
        forms,
        plugin(function({ matchUtilities, theme }) {
            matchUtilities(
                {
                    'animate-duration': (value) => ({
                        animationDuration: value,
                    }),
                },
                { values: theme('transitionDuration') }
            )
        }),
        function({ addUtilities }) {
            addUtilities({
                '.hide-scrollbar': {
                    'scrollbar-width': 'none', /* Firefox */
                    '&::-webkit-scrollbar': {
                        'display': 'none', /* Chrome, Safari, and Opera */
                    },
                },
            });
        },
    ],
};
