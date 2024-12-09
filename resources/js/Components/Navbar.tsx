import { Link, usePage } from "@inertiajs/react";
import { Button } from "primereact/button";
import { Sidebar } from "primereact/sidebar";

export default function Navbar({
    className,
    ...props
}: {
    className?: string
}) {
    const { user } = usePage().props.auth;
    const [balance, setBalance] = useState(0);
    const [sidebar, setSidebar] = useState(false);
    const [loadingBalance, setLoadingBalance] = useState(false);
    const label = useMemo(() => {
        if (loadingBalance) {
            return <i className="pi pi-spin pi-spinner" />
        }
        if (balance === 0) {
            return 'Tap for balance'
        }

        return `${balance}`
    }, [loadingBalance, balance])

    const balanceIconTransitionClass = useMemo(() => {
        if (!loadingBalance && balance === 0) {
            return 'left-2'
        }
        return 'right-2'
    }, [loadingBalance, balance])
    const refreshBalance = () => {
        if (loadingBalance || balance > 0) {
            return;
        }
        setLoadingBalance(true);
        setTimeout(() => {
            setBalance(parseFloat(Math.floor(Math.random() * 1000).toFixed(2)));
            setLoadingBalance(false);
        }, 1000)
    }
    const resetBalance = () => {
        setBalance(0);
    }
    useEffect(() => {
        if (balance > 0 && !loadingBalance) {
            setTimeout(() => {
                resetBalance();
            }, 3000)
        }
    }, [balance])

    return (
        <div className={`bg-primary px-0.5 py-3 sm:p-4 flex items-center justify-between ${className}`} {...props}>
            <div className="flex items-center gap-1 sm:gap-4">
                <Button className="!p-1.5" onClick={() => setSidebar(!sidebar)} text icon={(options) => (<HugeiconsMenu02 className="text-white w-6 h-6" {...options} />)} />
                <Sidebar visible={sidebar} onHide={() => setSidebar(false)}>
                    <img src="/assets/logo-long.png" className="mx-auto w-52 mb-3" alt="Paykaa Logo" />
                    <ul className="flex flex-col gap-2">
                        <li>
                            <Link href={route('profile.edit')} className="px-2 mt-2">
                                <Button severity="contrast" link text label="Profile" className="flex gap-3 w-full text-start items-center" icon={(options) => (<HeroiconsUser className="w-6 h-6" {...options} />)} />
                            </Link>
                        </li>
                    </ul>
                </Sidebar>
                <div className="flex gap-1 items-center">
                    <HugeiconsUserCircle className="w-10 h-10 text-white" />
                    <div>
                        <label className="text-white text-sm font-medium mb-0 ms-1">{user.name}</label>
                        <Button onClick={e => refreshBalance()} rounded text className="bg-white !py-1 ring-0 text-primary inline-flex relative items-center justify-center gap-2 text-white w-36">
                            <HeroiconsCurrencyBangladeshiSolid className={"h-5 w-5 absolute text-primary " + balanceIconTransitionClass} />
                            <div className="grow ps-2 text-primary text-xs">
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

