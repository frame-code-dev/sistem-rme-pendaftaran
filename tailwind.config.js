/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./node_modules/flowbite/**/*.js",
        "./app/Views/**/*.php" ],
    theme: {
      extend: {},
    },
    plugins: [
        require('flowbite/plugin')
    ]
}