import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            backgroundImage: {
                'hero-pattern': "url('/bg/22001.jpg')",
            },
            colors: {
                "outline": "#8b919e",
                "on-primary": "#003060",
                "tertiary-container": "#5f7f00",
                "on-surface": "#e2e2e2",
                "surface": "#131313",
                "on-primary-container": "#fdfbff",
                "surface-container-high": "#2a2a2a",
                "surface-container-highest": "#353535",
                "on-secondary": "#163152",
                "surface-dim": "#131313",
                "tertiary-fixed": "#c2f446",
                "secondary-fixed-dim": "#afc8f0",
                "on-primary-fixed-variant": "#004788",
                "secondary-fixed": "#d4e3ff",
                "primary-fixed-dim": "#a7c8ff",
                "legal-green": "#007861",
                "surface-charcoal": "#0A0A0A",
                "on-tertiary-fixed-variant": "#394d00",
                "tertiary": "#a7d628",
                "primary": "#a7c8ff",
                "on-tertiary-container": "#fbffe7",
                "surface-container": "#1f1f1f",
                "outline-variant": "#414753",
                "error-container": "#93000a",
                "inverse-surface": "#e2e2e2",
                "surface-tint": "#a7c8ff",
                "surface-bright": "#393939",
                "on-secondary-fixed": "#001c3a",
                "inverse-primary": "#005eb2",
                "secondary": "#afc8f0",
                "inverse-on-surface": "#303030",
                "on-tertiary": "#263500",
                "surface-container-lowest": "#0e0e0e",
                "secondary-container": "#2f486a",
                "on-error-container": "#ffdad6",
                "tertiary-fixed-dim": "#a7d628",
                "primary-fixed": "#d5e3ff",
                "on-primary-fixed": "#001b3b",
                "on-surface-variant": "#c1c6d5",
                "on-background": "#e2e2e2",
                "surface-variant": "#353535",
                "text-muted": "#8E8E8E",
                "background": "#131313",
                "on-secondary-container": "#9eb7de",
                "surface-container-low": "#1b1b1b",
                "border-subtle": "#1A1A1A",
                "primary-container": "#0074d9",
                "error": "#ffb4ab",
                "on-tertiary-fixed": "#151f00",
                "on-secondary-fixed-variant": "#2f486a",
                "on-error": "#690005"
            },
            borderRadius: {
                "DEFAULT": "0.125rem",
                "lg": "0.25rem",
                "xl": "0.5rem",
                "full": "0.75rem"
            },
            spacing: {
                "unit": "8px",
                "gutter": "24px",
                "margin-mobile": "16px",
                "container-max": "1280px",
                "margin-desktop": "64px",
                "margin-tablet": "32px"
            },
            fontFamily: {
                "headline-lg-mobile": ["Inter"],
                "label-md": ["JetBrains Mono"],
                "headline-lg": ["Inter"],
                "body-lg": ["Inter"],
                "headline-md": ["Inter"],
                "display-lg": ["Inter"],
                "body-md": ["Inter"],
                "label-sm": ["JetBrains Mono"],
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                "headline-lg-mobile": ["28px", { "lineHeight": "36px", "fontWeight": "600" }],
                "label-md": ["14px", { "lineHeight": "20px", "letterSpacing": "0.05em", "fontWeight": "500" }],
                "headline-lg": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600" }],
                "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
                "headline-md": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
                "display-lg": ["48px", { "lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                "label-sm": ["12px", { "lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "500" }]
            }
        },
    },

    plugins: [forms, require('@tailwindcss/container-queries')],
};
