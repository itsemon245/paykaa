import { Link, usePage } from "@inertiajs/react";
import { Button } from "primereact/button";
import { Card } from "primereact/card";
import { Sidebar } from "primereact/sidebar";
import { Tag } from "primereact/tag";
import toast from "react-hot-toast";
import autoAnimate from '@formkit/auto-animate'
import { useRef } from "react";
import { motion } from "motion/react"
import useBreakpoint from "@/Hooks/useBrakpoints";
import { cn } from "@/utils";

export default function Navbar({
    className,
    toggleSidebar,
    isSidebarOpen,
    ...props
}: {
    className?: string,
    toggleSidebar: () => void,
    isSidebarOpen: boolean
}) {
    const { user } = useAuth();
    const animationParentRef = useRef<HTMLDivElement>(null);
    const [balance, setBalance] = useState(0);
    const { min, max } = useBreakpoint();
    const [isBalanceVisible, setIsBalanceVisible] = useState(false);
    const [loadingBalance, setLoadingBalance] = useState(false);
    const label = useMemo(() => {
        if (loadingBalance) {
            return <i className="pi pi-spin pi-spinner text-xs" />
        }
        if (!isBalanceVisible) {
            return 'Tap for balance'
        }

        return balance.toLocaleString('en-IN', { style: 'currency', currency: 'BDT' })
    }, [loadingBalance, isBalanceVisible])

    const balanceIconTransitionClass = useMemo(() => {
        if (!loadingBalance && !isBalanceVisible) {
            return 'left-2'
        }
        return 'right-2'
    }, [loadingBalance, isBalanceVisible])
    const refreshBalance = async () => {
        if (loadingBalance || isBalanceVisible) {
            return;
        }
        setIsBalanceVisible(true);
        setLoadingBalance(true);
        const res = await fetch(route('wallet.check-balance'));
        if (!res.ok) {
            toast.error('Failed to refresh balance');
            console.log("Error refreshing balance", res);
            setLoadingBalance(false);
            return;
        }
        const data = await res.json();
        setBalance(data.balance);
        setLoadingBalance(false);
    }
    useEffect(() => {
        if (isBalanceVisible) {
            const timeout = setTimeout(() => {
                setIsBalanceVisible(false);
            }, 3000);
            return () => clearTimeout(timeout);
        }
    }, [isBalanceVisible])
    useEffect(() => {
        if (animationParentRef.current) {
            autoAnimate(animationParentRef.current);
        }
    }, [animationParentRef])

    return (
        <div className={`mt-4 md:mt-8 py-3 flex items-center justify-between ${className}`} {...props}>
            <div className="flex items-center gap-1 sm:gap-4">
                <div className="flex gap-2 items-center">
                    {max('md') && <SidebarCloseBtn isSidebarOpen={isSidebarOpen} toggleSidebar={toggleSidebar} />}
                    <img src={user.avatar} className="w-14 h-14 md:w-[72px] md:h-[72px] rounded-full border-white border-2 object-cover" />
                    <div ref={animationParentRef} className="flex flex-col items-start">
                        <label className="text-white text-base md:text-lg font-bold mb-0">{user.name}</label>
                        <button onClick={refreshBalance} className="bg-white min-w-36 md:min-w-48 text-center py-1 md:py-1.5 rounded-xl text-primary text-sm md:text-base font-medium">{label}</button>
                    </div>
                </div>

            </div>
            <Button className="!p-1.5 border border-white" text rounded>
                <FlowbiteBellRingSolid className="text-white w-8 h-8" />
            </Button>
        </div>

    )
}

