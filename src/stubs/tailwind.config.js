module.exports = {
  purge: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.vue',
    './resources/css/**/*.css',
  ],
  theme: {
    extend: {
      //
    },
  },
  variants: {
    //
  },
  plugins: [
    require('@tailwindcss/custom-forms'),
  ],
}
