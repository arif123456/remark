/** @type {import('tailwindcss').Config} */
module.exports = {
  mode: 'jit',
  purge: [
    './*.php',
    './**/*.php'
  ],
  theme: {
    screens: {
      sm: '640px',
      md: '768px',
      lg: '1024px',
      xl: '1170px',
      '2xl': '1536px'
    },
    container: {
      center: true,
      padding: '1rem'
    },
    extend: {},
  },
  plugins: [],
}
