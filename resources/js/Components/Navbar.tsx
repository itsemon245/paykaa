import autoAnimate from '@formkit/auto-animate'
import { useRef } from "react";
import useBreakpoint from "@/Hooks/useBrakpoints";
import { copyToClipboard, defaultAvatar, image } from "@/utils";

export default function Navbar({
    className,
    toggleSidebar,
    isSidebarOpen,
    ...props
}: {
    className?: string,
    toggleSidebar?: () => void,
    isSidebarOpen: boolean
}) {
    const { user } = useAuth();
    const animationParentRef = useRef<HTMLDivElement>(null);
    const { balance, isBalanceVisible, loadingBalance, refreshBalance } = useBalance();
    const { max } = useBreakpoint();
    const label = useMemo(() => {
        if (loadingBalance) {
            return <i className="pi pi-spin pi-spinner text-xs" />
        }
        if (!isBalanceVisible) {
            return 'Tap for balance'
        }

        return balance.toLocaleString('en-IN', { style: 'currency', currency: 'BDT' })
    }, [loadingBalance, isBalanceVisible])
    useEffect(() => {
        console.log(user)
        if (animationParentRef.current) {
            autoAnimate(animationParentRef.current);
        }
    }, [animationParentRef])

    return (
        <div className={`mt-4 md:mt-8 py-3 flex items-center justify-between ${className}`} {...props}>
            <div className="flex items-center gap-1 sm:gap-4">
                <div className="flex gap-2 items-center">
                    {max('md') && toggleSidebar && <SidebarCloseBtn isSidebarOpen={isSidebarOpen} toggleSidebar={toggleSidebar} />}
                    <img src={image(user.avatar)}
                        onError={(e) => {
                            //@ts-ignore
                            e.target.src = defaultAvatar
                        }}
                        className="w-14 h-14 md:w-[72px] md:h-[72px] rounded-full border-white border-2 object-cover" />
                    <div ref={animationParentRef} className="flex flex-col items-start">
                        <label className="text-white text-base md:text-lg font-bold mb-0">{user.name}</label>
                        <div className="flex gap-2 items-center mb-0.5 -mt-1.5">
                            <label className="text-white text-sm font-bold mb-0"> UID: {user.id}</label>
                            <HugeiconsCopy01 className="text-white w-4 h-4 cursor-pointer" onClick={() => copyToClipboard(user.id)} />
                        </div>
                        <button onClick={refreshBalance} className="bg-white min-w-36 md:min-w-48 text-center py-1 md:py-1.5 rounded-xl text-primary text-sm md:text-base font-medium">{label}</button>
                    </div>
                </div>

            </div>
            <Notifications />
        </div>

    )
}

