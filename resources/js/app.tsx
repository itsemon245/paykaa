import '../css/app.css';
import './bootstrap';
import 'primereact/resources/themes/lara-light-indigo/theme.css'

import { createInertiaApp } from '@inertiajs/react';
import { createRoot, hydrateRoot } from 'react-dom/client';
import appConfig from './app-config';
import { APIOptions, PrimeReactProvider } from 'primereact/api';
import Tailwind from 'primereact/passthrough/tailwind';
import PrimeOptions from './theme/PrimeOptions';

createInertiaApp({
    ...appConfig,
    setup({ el, App, props }) {
        if (import.meta.env.SSR) {
            hydrateRoot(el, <App {...props} />);
            return;
        }
        const root = createRoot(el);
        root.render(
            <PrimeReactProvider value={PrimeOptions}>
                <App {...props} />
            </PrimeReactProvider>
        );
    },
    progress: {
        color: '#4B5563',
    },
});
