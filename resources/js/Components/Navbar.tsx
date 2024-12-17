import { Link, usePage } from "@inertiajs/react";
import { Button } from "primereact/button";
import { Sidebar } from "primereact/sidebar";
import toast from "react-hot-toast";

export default function Navbar({
    className,
    ...props
}: {
    className?: string
}) {
    const { user } = useAuth();
    const [balance, setBalance] = useState(0);
    const [sidebar, setSidebar] = useState(false);
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

    return (
        <div className={`bg-primary px-0.5 py-3 sm:p-4 flex items-center justify-between ${className}`} {...props}>
            <div className="flex items-center gap-1 sm:gap-4">
                <Button className="!p-1.5" onClick={() => setSidebar(!sidebar)} text icon={(options) => (<HugeiconsMenu02 className="text-white w-6 h-6" {...options} />)} />
                <Sidebar visible={sidebar} onHide={() => setSidebar(false)}>
                    <Link href="/dashboard" className="flex items-center gap-2 text-white mb-4">
                        <img src="/assets/logo-long.png" className="mx-auto w-52 mb-4" alt="Paykaa Logo" />
                    </Link>
                    <ul className="flex flex-col justify-start gap-1">
                        <li>
                            <Link href={route('profile.edit')}>
                                <Button severity="contrast" link text label="Profile" className="flex !p-3 gap-3 w-full text-start items-center" icon={(options) => (<HeroiconsUser className="w-6 h-6" {...options} />)} />
                            </Link>
                        </li>
                        <li>
                            <Link href={route('logout')} method="post">
                                <Button severity="contrast" link text label="Logout" className="flex !p-3 gap-3 w-full text-start items-center" icon={(options) => (< HugeiconsLogout03 className="w-6 h-6" {...options} />)} />
                            </Link>
                        </li>
                    </ul>
                </Sidebar>
                <div className="flex gap-1 items-center">
                    <HugeiconsUserCircle className="w-10 h-10 text-white" />
                    <div>
                        <label className="text-white text-sm font-medium mb-0 ms-1">{user.name}</label>
                        <Button onClick={e => refreshBalance()} rounded text className="bg-white !py-1 ring-0 text-primary inline-flex relative items-center justify-center gap-2 text-white w-44">
                            <HeroiconsCurrencyBangladeshiSolid className={"h-5 w-5 absolute text-primary " + balanceIconTransitionClass} />
                            <div className="grow px-2 text-primary text-xs">
                                {label}
                            </div>
                        </Button>
                    </div>
                </div>

            </div>
            <Button className="!p-1.5" text icon={(options) => (<HugeiconsNotification03 className="text-white w-6 h-6" {...options} />)} />
        </div>

    )
}

