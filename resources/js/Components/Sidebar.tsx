import menuItems, { MenuItem } from "@/data/menuItems";
import useBreakpoint from "@/Hooks/useBrakpoints";
import { ButtonSeverity } from "@/types";
import { cn } from "@/utils";
import { Link, router } from "@inertiajs/react";
import { Button } from "primereact/button";
import { Card } from "primereact/card";
import { motion } from "motion/react"

export default function Sidebar({
    className,
    isSidebarOpen,
    toggleSidebar
}: { className?: string, isSidebarOpen: boolean, toggleSidebar: () => void }) {
    const { max } = useBreakpoint();
    const extraMenus: MenuItem[] = [
        {
            label: "Profile",
            icon: "/assets/dashboard/profile.png",
            url: route('profile.edit'),
            isActive: () => route().current('profile.edit'),
        },
        {
            label: "PyaKaa Wallet",
            icon: "/assets/dashboard/wallet.png",
            url: "#",
            isActive: () => false,
        }
    ]
    return <motion.aside initial={{ x: -500 }} animate={{ x: 0 }} exit={{ x: -500 }} transition={{ duration: 0.5 }} className={cn("h-max max-w-[245px] xl:max-w-[300px] w-full my-auto", className)}>
        <Card className="bg-white bg-opacity-55 shadow-md h-max">
            <div className="flex flex-col items-center w-full h-[90dvh] px-3 gap-1 overflow-y-scroll hide-scrollbar">
                <div className="flex items-center gap-2 w-full justify-between mb-10">
                    {max('md') && <SidebarCloseBtn className="!text-primary" isSidebarOpen={isSidebarOpen} toggleSidebar={toggleSidebar} />}
                    <Link href={route('dashboard')} className="cursor-pointer w-full" >
                        <Logo />
                    </Link>
                </div>
                {extraMenus.map(item => (
                    <Link href={item.url} className="cursor-pointer w-full" key={item.label + "-menu-item-sidebar"}>
                        <Button label={item.label} className={cn("w-full !p-3 rounded-2xl text-nowrap")} text={!item.isActive()} severity={item.isActive() ? undefined : 'contrast' as ButtonSeverity}>
                        </Button>
                    </Link>
                ))}
                {menuItems.map(item => (
                    <Link href={item.url} className="cursor-pointer w-full" key={item.label + "-menu-item-sidebar"}>
                        <Button label={item.label} className={cn("w-full !p-3 rounded-2xl text-nowrap")} text={!item.isActive()} severity={item.isActive() ? undefined : 'contrast' as ButtonSeverity}>
                        </Button>
                    </Link>
                ))}
            </div>
        </Card>
    </motion.aside>
}
