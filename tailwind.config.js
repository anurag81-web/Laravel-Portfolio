import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    // plugins: [forms], // v4 auto-imports forms if using @theme? No, better to keep plain. 
    // Actually, v4 @import 'tailwindcss' includes base.
    // If using plugins, we might need to import them in CSS or keep basic config.
    plugins: [forms],
};
