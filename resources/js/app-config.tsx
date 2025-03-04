import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import BaseLayout from "./Layouts/BaseLayout";
import DashboardLayout from "./Layouts/DashboarLayout";

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

const appConfig = {
    title: (title: string) => `${title} - ${appName}`,
    resolve: (name: string) => {
        const page = resolvePageComponent(
            `./Pages/${name}.tsx`,
            import.meta.glob('./Pages/**/*.tsx'),
        );
        const layoutMap = [
            {
                pageDir: ['Auth'],
                component: (page: any) => <GuestLayout children={page} />,
            },
            {
                pageDir: ['Chat'],
                component: (page: any) => <ChatLayout children={page} />,
            },
            {
                pageDir: ['Dashboard', 'Add', 'Referall'],
                component: (page: any) => <DashboardLayout children={page} />,
            },
            {
                pageDir: ['Profile', 'Wallet'],
                component: (page: any) => <ProfileLayout children={page} />,
            },
        ]
        page.then((mod: any) => {
            const layout = layoutMap.find(item => item.pageDir.indexOf(name.split('/')[0]) !== -1);
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
