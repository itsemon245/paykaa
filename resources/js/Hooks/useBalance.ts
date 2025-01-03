import toast from "react-hot-toast";

export default function useBalance() {
    const [balance, setBalance] = useState(0);
    const [isBalanceVisible, setIsBalanceVisible] = useState(false);
    const [loadingBalance, setLoadingBalance] = useState(false);
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
        refreshBalance();
    }, [])
    return {
        balance,
        isBalanceVisible,
        loadingBalance,
        refreshBalance,
    }
}
