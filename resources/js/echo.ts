import BaseEcho from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;
//add reference of Pusher to window
declare global {
    interface Window {
        Pusher: any;
        Echo: BaseEcho<'reverb'>;
    }
}

export const Echo = new BaseEcho({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

window.Echo = Echo;
