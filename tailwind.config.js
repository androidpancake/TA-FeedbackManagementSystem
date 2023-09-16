/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./node_modules/flowbite/**/*.js",
    "./node_modules/chart.js/**/*.js",
    "./node_modules/tw-elements/dist/js/**/*.js"

  ],
  theme: {
    extend: {
      screens : {
        '2md' : '1060px'
      }
    },
  },
  plugins: [
    require('flowbite/plugin'),
    require('tw-elements/dist/plugin.cjs')
  ],
}

