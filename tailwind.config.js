/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.{html,css,js,php}"],
  theme: {
    extend: {
      fontFamily: {
        "Poppins": ["Poppins", "sans-serif"],
        "Outfit": ["Outfit", "sans-serif"],
      }
    },
  },
  plugins: [],
}
