import useBreakpoint from '@/Hooks/useBrakpoints';
import { RouteName } from '@/types';
import { cn } from '@/utils';
import { Link } from '@inertiajs/react';
import { Button } from 'primereact/button'
import { InputText } from 'primereact/inputtext'
import { Sidebar } from 'primereact/sidebar';


interface NavLink {
    label: string;
    route: RouteName;
}

export default function ClassicNav() {
    const navLinks: NavLink[] = [
        {
            label: "Home",
            route: "dashboard",
        },
        {
            label: "P2P",
            route: "marketplace.index",
        },
        {
            label: "Ads",
            route: "add.index",
        },
        {
            label: "Chat",
            route: "chat.index",
        },
        {
            label: "Earn",
            route: "wallet.deposit.index",
        },
        {
            label: "Account",
            route: "profile.edit",
        },
    ]
    const { min, max } = useBreakpoint()
    const [visibleRight, setVisibleRight] = useState(false);
    return (
        <div className="flex max-sm:gap-8 sm:grid sm:grid-cols-2 justify-center py-4 px-3 items-center">
            <div className="flex justify-center">
                <Logo className="!w-28 sm:h-8 sm:w-auto object-contain" />
            </div>
            <div className="flex gap-3 items-center justify-between lg:grid lg:grid-cols-2 lg:justify-center">
                <div className="flex lg:w-[80%]">
                    <InputText placeholder="Search" className="rounded-r-none" />
                    <button className="p-button rounded-l-none">
                        {!max(500) ? "Search" : <i className="pi pi-search text-xl font-bold" />}
                    </button>
                </div>
                <button onClick={() => setVisibleRight(true)} className="flex lg:hidden h-10 w-10 items-center justify-center text-gray-100">
                    <i className="pi pi-bars text-xl font-bold" />
                </button>
                <Sidebar header={<Logo className="!w-28 sm:h-8 sm:w-auto object-contain" />} visible={visibleRight} position="right" onHide={() => setVisibleRight(false)}>
                    <ul className='w-full flex flex-col gap-2'>
                        {navLinks.map((item, index) => (
                            <li key={index} className="w-full block">
                                <Link className={cn("transition-all duration-300 px-3 py-1.5 rounded hover:bg-gray-100 block !w-full *:w-full", route().current(item.route) ? "bg-gray-200" : '')} href={route(item.route)}>
                                    {item.label}
                                </Link>
                            </li>
                        ))}
                    </ul>
                </Sidebar>
                <ul className="hidden items-center gap-1 text-gray-100 font-bold lg:flex">
                    {navLinks.map((item, index) => (
                        <li key={index}>
                            <Link className={cn("transition-all duration-300 px-3 py-1.5 rounded hover:bg-primary-400", route().current(item.route) ? "bg-primary-400" : '')} href={route(item.route)}>
                                {item.label}
                            </Link>
                        </li>
                    ))}
                </ul>
            </div>
        </div>
    )
}
