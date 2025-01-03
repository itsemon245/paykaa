import Sidebar from "@/Components/Sidebar";
import useBreakpoint from "@/Hooks/useBrakpoints";
import { cn } from "@/utils";
import { Link, usePage } from "@inertiajs/react";
import { motion } from "motion/react"
import { Button } from "primereact/button";
interface MenuItem {
    label: string;
    url: string;
    active: boolean;
}
export default function DashboardLayout({ children, animate }: { children?: JSX.Element | JSX.Element[], animate?: boolean }) {
    const { min, max, between } = useBreakpoint();
    const [isSidebarOpen, setIsSidebarOpen] = useState(false);
    const LinkItem = ({
        item,
    }: {
        item: MenuItem;
    }) => {
        return <Link href={item.url!}>
            <button className={cn("flex items-center font-bold justify-center gap-2 px-3 py-1.5 rounded-lg", item.active ? 'bg-[var(--green-500)]  text-white' : 'text-gray-700')}>
                {item.label}
            </button>
        </Link>
    }

    const [menuItems, setMenuItems] = useState<MenuItem[]>([
        {
            label: "Home",
            url: route('dashboard'),
            active: route().current('dashboard'),
        },
        {
            label: "Account",
            url: route('profile.edit'),
            active: route().current('profile.edit'),
        },
        {
            label: "Deposit",
            url: route('wallet.deposit.index'),
            active: route().current('wallet.deposit.index'),
        },
        {
            label: "Withdraw",
            url: route('wallet.withdraw.index'),
            active: route().current('wallet.withdraw.index'),
        },
        {
            label: "Transactions",
            url: route('wallet.transactions.index'),
            active: route().current('wallet.transactions.index'),
        },
    ])
    return (
        <BaseLayout>
            <SquareBg animate={animate} />
            <div className="flex gap-4 relative justify-center z-10 h-screen px-2 w-screen overflow-x-hidden">
                <div className={cn("grow mt-5 sm:px-3 overflow-y-scroll hide-scrollbar transition duration-500", max('sm') && isSidebarOpen ? 'translate-x-[1000px]' : '')}>
                    <div className="grid lg:grid-cols-3 gap-5 justify-center mb-5 pb-3 border-b">
                        <div className="flex lg:col-span-2 2xl:col-span-1 items-center justify-center gap-3 px-3">
                            {menuItems.map((item, i) => (
                                <LinkItem item={item} key={i} />
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
