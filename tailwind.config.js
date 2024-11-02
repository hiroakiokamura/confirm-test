/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      colors: {
        'main-color': '#8b7969',
        'button-color': '#6b5344',
        'cream-color': '#f1ece6',
        'placeholder-color': '#c6e6ff',
      },
    },
  },
  plugins: [],
}

