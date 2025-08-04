// tailwind.config.js
module.exports = {
  content: [
    './resources/**/*.blade.php', // or wherever your HTML/Blade files are
    './resources/**/*.js',
    './resources/**/*.vue'
  ],
  theme: {
    extend: {
      colors: {
        'pam-blue': '#1e3a8a',
        'pam-blue-light': '#3b82f6',
        'pam-green': '#10b981',
        'pam-red': '#ef4444',
        'pam-orange': '#f97316',
        'pam-gray': '#6b7280',
        'pam-gray-light': '#f3f4f6',
      },
      fontFamily: {
        sans: ['Inter', 'sans-serif'],
      },
      transitionProperty: {
        'height': 'height',
        'spacing': 'margin, padding',
      },
    }
  },
  plugins: [],
}
