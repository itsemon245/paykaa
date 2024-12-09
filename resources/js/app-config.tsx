import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { PrimeReactProvider, PrimeReactContext } from 'primereact/api';
import BaseLayout from "./Layouts/BaseLayout";
import { ReactNode } from "react";
import DashboardLayout from "./Layouts/DashboarLayout";

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
Object.defineProperty(Array.prototype, 'chunk', {
    value: function(chunkSize: number) {
        var R = [];
        for (var i = 0; i < this.length; i += chunkSize)
            R.push(this.slice(i, i + chunkSize));
        return R;
    }
});

const appConfig = {
    title: (title: string) => `${title} - ${appName}`,
    resolve: (name: string) => {
        const page = resolvePageComponent(
            `./Pages/${name}.tsx`,
            import.meta.glob('./Pages/**/*.tsx'),
        );
        page.then((mod: any) => {
            if (name.startsWith('Chat')) {
                mod.default.layout = mod.default.layout || <AuthenticatedLayout children={page} />;
            }
            mod.default.layout = mod.default.layout || <BaseLayout children={page} />;
        });
        return page
    }

}
export default appConfig;
