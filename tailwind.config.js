/** @type {import('tailwindcss').Config} */
module.exports = {
  
  theme: {
    extend: {
      colors: {
        'pam-blue': '#1e3a8a',
        'pam-blue-light': '#3b82f6',
        'pam-green': '#10b981',
        'pam-gray': '#6b7280',
        'pam-gray-light': '#f3f4f6',
      },
      fontFamily: {
        sans: ['Inter', 'sans-serif'],
      },
      boxShadow: {
        'tab-active': '0 2px 0px -1px rgba(59, 130, 246, 0.5)',
      }
    }
  },
  plugins: [],
}