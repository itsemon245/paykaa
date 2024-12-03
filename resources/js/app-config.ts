import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { PrimeReactProvider, PrimeReactContext } from 'primereact/api';
import BaseLayout from "./Layouts/BaseLayout";
import { ReactNode } from "react";

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

const appConfig = {
    title: (title: string) => `${title} - ${appName}`,
    resolve: (name: string) => {
        const pages = import.meta.glob('./Pages/**/*.jsx')
        let currentPage = `./Pages/${name}.tsx`
        let page = resolvePageComponent(currentPage, pages) as any;
        console.log(page)
        if (page) {
            page.default.layout = page.default.layout || BaseLayout({ children: page })
        }
        console.log('after', page)
        return page;
    }

}
export default appConfig;
