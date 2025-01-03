export interface MenuItem {
    label: string;
    icon: string;
    url: string;
    isActive: () => boolean;
    className?: string;
}
const menuItems = [
    {
        label: "Deposit",
        icon: "/assets/dashboard/deposit.png",
        url: route('wallet.deposit.index'),
        isActive: () => route().current('wallet.deposit.index'),
    },
    {
        label: "Withdraw",
        icon: "/assets/dashboard/withdraw.png",
        url: route('wallet.withdraw.index'),
        isActive: () => route().current('wallet.withdraw.index'),
    },
    {
        label: "P2P",
        icon: "/assets/dashboard/p2p.png",
        url: "#",
        isActive: () => false,
    },
    {
        label: "Ads",
        icon: "/assets/dashboard/ads.png",
        url: "#",
        isActive: () => false,
    },
    {
        label: "Referral",
        icon: "/assets/dashboard/referral.png",
        url: "#",
        isActive: () => false,
    },
    {
        label: "Earn",
        icon: "/assets/dashboard/earn.png",
        url: "#",
        isActive: () => false,
    },
    {
        label: "Transaction",
        icon: "/assets/dashboard/transaction.png",
        url: route('wallet.transactions.index'),
        isActive: () => route().current('wallet.transactions.index'),
    },
    {
        label: "Help Line",
        icon: "/assets/dashboard/help.png",
        url: "#",
        isActive: () => false,
    },
] as const
export default menuItems;
