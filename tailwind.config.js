/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./vendor/mckenziearts/laravel-notify/resources/views/**/*.blade.php",
        "./vendor/damms005/laravel-multipay/views/**/*.blade.php"
    ],
    theme: {
        extend: {},
    },
    plugins: [],
}
