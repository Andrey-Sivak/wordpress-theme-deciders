const spacing = require('./tailwind-settings/spacing');
const fontSize = require('./tailwind-settings/fontSize');
const lineHeight = require('./tailwind-settings/lineHeight.js');

/** @type {import('tailwindcss').Config} */
module.exports = {
    future: {
        hoverOnlyWhenSupported: true,
    },
    mode: "jit",
    content: [
        '**/*.php',
        '!vendor/**/*.php',
        './assets/js/**/*.js',
        './assets/scss/**/*.scss',
    ],
    theme: {
        extend: {
            spacing,
            transitionDuration: {
                600: '600ms',
                700: '700ms',
                800: '800ms',
                900: '900ms',
            },
            colors: {
                'opora-blue': '#0169ED',
            },
            fontFamily: {
                'grtsk-tera': 'TRY Grtsk Tera, sans-serif',
                'grtsk-peta': 'TRY Grtsk Peta, sans-serif',
            },
            lineHeight,
            fontSize,
            borderRadius: {},
            boxShadow: {},
            maxWidth: {},
            screens: {
                hg: '1919px',
                '1.5xl': '1440px',
            },
            gridTemplateColumns: {},
            gridTemplateRows: {},
            gridAutoRows: {},
            zIndex: {},
        },
    },
    plugins: [],
    corePlugins: {
        // preflight: false,
    }
}
