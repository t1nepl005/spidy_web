export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        spider: {
          primary: '#ff6fae',   // light pink
          secondary: '#ffffff', // white
          accent: '#000000',    // black
          dark: '#e63e85',      // deeper pink
          soft: '#f5f5f5',      // soft gray
        }
      },
      fontFamily: {
        heading: ['Poppins', 'sans-serif'],
        body: ['Inter', 'sans-serif'],
      },
      spacing: {
        'fluid': 'clamp(1rem, 2vw, 2rem)', // responsive spacing
      },
      borderRadius: {
        'xl': '1rem',
        '2xl': '1.5rem',
      },
      boxShadow: {
        'soft': '0 4px 12px rgba(0,0,0,0.1)',
      },
    },
  }
}