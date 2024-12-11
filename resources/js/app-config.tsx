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
        const layoutMap = [
            {
                pageDir: 'Chat',
                component: (page: any) => <ChatLayout children={page} />,
            }
        ]
        page.then((mod: any) => {
            const layout = layoutMap.find(item => item.pageDir === name.split('/')[0]);
            if (layout) {
                mod.default.layout = mod.default.layout || layout.component;
            } else {
                mod.default.layout = mod.default.layout || ((page: any) => <BaseLayout children={page} />);
            }
        });
        return page
    }

}
export default appConfig;
