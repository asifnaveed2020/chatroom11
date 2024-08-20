import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;
const configu ={
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
};
console.log('Hello world',configu);
window.Echo = new Echo(configu);

window.Echo.channel('broadcastme')
    .listen('.sendMessage', (event) => {
        console.log('Message received:', event.message);
    });