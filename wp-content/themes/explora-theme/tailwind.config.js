/** @type {import('tailwindcss').Config} config */
const config = {
  content: [
    './index.php', 
    './app/**/*.php', 
    './resources/**/*.{php,vue,js}',
  ],
  theme: {
    extend: {
      colors: {
        'exp-yellow-300':'#EFC944',
        'exp-red-300':'#AE0521',
        // 'exp-red-300':'#BD102F',
        'exp-blue-300':'#112062',
        'exp-green-200':'#73961B',
        'exp-green-300':'#007C35',
        
        'exp-cyan-300':'#1D87AC',
        'exp-magenta-300':'#CE4783',
        'exp-orange-300':'#E44320',
      }, // Extend Tailwind's default colors
      fontFamily: {
        'explora-font': ['"IBM Plex Sans"', 'serif-serif'],
      },
    },
    colors: {
      black: '#000',
      white: '#fff',
    }
  },
  variants: {},
  plugins: [],
};

export default config;
