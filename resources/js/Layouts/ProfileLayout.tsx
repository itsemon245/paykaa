import Sidebar from "@/Components/Sidebar";
import useBreakpoint from "@/Hooks/useBrakpoints";
import { RouteName } from "@/types";
import { cn } from "@/utils";
import { Link, usePage } from "@inertiajs/react";
interface MenuItem {
    label: string;
    route: RouteName;
}
export default function ProfileLayout({ children, animate }: { children?: JSX.Element | JSX.Element[], animate?: boolean }) {
    const { min, max, between } = useBreakpoint();
    const [isSidebarOpen, setIsSidebarOpen] = useState(false);

    const [menuItems, setMenuItems] = useState<MenuItem[]>([
        {
            label: "Home",
            route: 'dashboard',
        },
        {
            label: "Deposit",
            route: 'wallet.deposit.index',
        },
        {
            label: "Withdraw",
            route: 'wallet.withdraw.index',
        },
        {
            label: "Transactions",
            route: 'wallet.transactions.index',
        },
    ])
    return (
        <BaseLayout>
            <SquareBg />
            <ClassicNav />
            <div className="flex gap-4 relative justify-center z-10 h-screen px-2 w-screen overflow-x-hidden">
                <div className={cn("grow !mt-5 sm:px-3 overflow-y-scroll hide-scrollbar transition duration-500", max('sm') && isSidebarOpen ? 'translate-x-[1000px]' : '')}>
                    <div className="grid lg:grid-cols-3 gap-5 justify-center !mb-5 pb-3 border-b">
                        <div className="flex lg:col-span-2 2xl:col-span-1 items-center justify-center gap-1 sm:gap-2 px-1 sm:px-3">
                            {menuItems.map((item, i) => (
                                <Link href={route(item.route)}>
                                    <button className={cn("text-center px-2 py-1 sm:px-3 sm:py-1.5 rounded-lg font-semibold max-sm:text-sm", route().current(item.route) ? 'bg-[var(--green-500)]  text-white' : 'text-gray-700')}>
                                        {item.label}
                                    </button>
                                </Link>
                            ))}
                        </div>
                    </div>
                    {children}
                </div>
            </div>
            <div className="z-[-1] fixed blur-lg -bottom-5 left-0 w-full h-[18vh] bg-gradient-to-t from-primary-200 to-transparent"></div>
        </BaseLayout>
    );
}
