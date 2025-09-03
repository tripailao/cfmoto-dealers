/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
      './resources/**/*.blade.php',
      './resources/**/*.js',
      './resources/**/*.vue', // Si usas Vue o cualquier JS personalizado
    ],
    theme: {
      extend: {},
    },
    darkMode: 'class', // 👈 Esto asegura que el modo oscuro solo se aplique con la clase "dark"
    plugins: [],
  };
