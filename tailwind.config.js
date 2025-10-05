import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    DEFAULT: '#b91c1c', // แดงเข้ม
                    dark: '#7f1d1d',
                },
                darkbg: '#18181b', // ดำเข้ม
                lightbg: '#27272a', // ดำเทา
            },
            textColor: {
                skin: {
                    base: '#f3f4f6', // สี font หลัก (เทาอ่อน)
                    muted: '#e5e7eb',
                    danger: '#f87171',
                },
            },
        },
    },

    plugins: [forms, typography],
};
