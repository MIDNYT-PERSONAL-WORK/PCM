import './bootstrap';
import Echo from 'laravel-echo';

window.Echo = new Echo({
    broadcaster: 'reverb', // Use 'reverb' as string, not the Reverb class
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST || window.location.hostname,
    wsPort: import.meta.env.VITE_REVERB_PORT || 8080,
    forceTLS: false,
});
console.log('Echo initialized:', window.Echo);