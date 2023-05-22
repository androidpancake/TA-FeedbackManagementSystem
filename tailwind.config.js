/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
      screens : {
        '2md' : '1060px'
      }
    },
  },
  plugins: [
    require('flowbite/plugin')
  ],
}

