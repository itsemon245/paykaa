import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { PrimeReactProvider, PrimeReactContext } from 'primereact/api';
import BaseLayout from "./Layouts/BaseLayout";
import { ReactNode } from "react";

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

const appConfig = {
    title: (title: string) => `${title} - ${appName}`,
    resolve: (name: string) => {
        const page = resolvePageComponent(
            `./Pages/${name}.tsx`,
            import.meta.glob('./Pages/**/*.tsx'),
        );
        page.then((mod: any) => {
            mod.default.layout = mod.default.layout || (page => <BaseLayout children={page} />);
        });
        return page
    }

}
export default appConfig;
