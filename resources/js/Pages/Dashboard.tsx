import DashboardLayout from "@/Layouts/DashboarLayout";
import { UserData } from "@/types/_generated";
import { Link } from "@inertiajs/react";
import { throttle } from "lodash";
import { Button } from "primereact/button";
import { Card } from "primereact/card";
import { InputText } from "primereact/inputtext";
import { ScrollPanel } from "primereact/scrollpanel";
import toast from "react-hot-toast";

interface MenuItem {
    label: string;
    icon: React.ReactNode;
    url: string;
    className?: string;
}
export default function Dashboard() {
    const { users, loading, searchString, search } = useUsers();
    const menuItems1: MenuItem[] = [
        {
            label: "Deposit",
            icon: <HugeiconsWalletAdd01 className="w-full h-full" />,
            url: route('wallet.deposit.index'),
        },
        {
            label: "Withdraw",
            icon: <GameIconsTakeMyMoney className="w-full h-full" />,
            url: "#",
        },
        {
            label: "P2P",
            icon: <LucideLabCoinsExchange className="w-full h-full" />,
            url: "#",
        },
        {
            label: "Ads",
            icon: <MingcuteAnnouncementLine className="w-full h-full" />,
            url: "#",
        }

    ];
    const menuItems2: MenuItem[] = [
        {
            label: "Refferal",
            icon: <HugeiconsUserAdd01 className="w-full h-full" />,
            url: "#",
        },
        {
            label: "Earn",
            icon: <GameIconsCash className="w-full h-full" />,
            url: "#",
        },
        {
            label: "Transaction",
            icon: <HugeiconsWorkHistory className="w-full h-full" />,
            url: "#",
        },
        {
            label: "Help Line",
            icon: <HugeiconsCustomerSupport className="w-full h-full" />,
            url: "#",
        },
    ]
    const menuItems = [
        menuItems1,
        menuItems2
    ]
    const itemTemplate = (user: UserData) => {
        return (
            <Link href={route('chat.receiver-chat', { receiver: user.uuid })} className="flex items-center p-3 h-max cursor-pointer">
                <img
                    alt={user.name}
                    src={user.avatar}
                    className="rounded-full w-10 me-2"
                />
                <div className="flex flex-col items-start select-none *:cursor-pointer">
                    <label className="font-bold mb-0 leading-none">{user.name}</label>
                    <label className="text-sm text-gray-500 mb-0">{user.email}</label>
                </div>
            </Link>
        );
    };
    return (
        <DashboardLayout>
            <Head title="Dashboard" />
            <div className="md:pt-20"></div>
            <div className="flex flex-col gap-3 sm:gap-6">
                <Card>
                    <div className="flex items-start justify-between gap-2 sm:gap-5 max-[320px]:flex-wrap">
                        <Link href={route('chat.index')} className="flex max-[320px]:w-full items-center h-max cursor-pointer">
                            <div className="flex max-[320px]:w-full max-[320px]:py-3 justify-center hover:shadow transition-all hover:scale-105 rounded-lg items-center h-max cursor-pointer sm:px-4 sm:py-2.5 p-2 border gap-3">
                                <HugeiconsBubbleChat className=" h-8 w-8 sm:h-14 sm:w-14" />
                                <span className="font-bold sm:text-lg">Chats</span>
                            </div>
                        </Link>

                        <div className="grow">
                            <div className="flex-1 relative flex items-center">
                                <input placeholder="Search user" className="!py-2.5 !rounded-2xl border-2 w-full border-primary-300 active:border-primary-500" onKeyUp={search} />
                                <button type="submit" className="absolute my-auto right-4">
                                    <i className="pi pi-search text-primary-500" />
                                </button>
                            </div>
                            {(users.length > 0 && searchString !== "") &&
                                <div className="rounded-md border-gray-200 mt-2 shadow">
                                    {loading ? (<div className="flex justify-center items-center p-3">
                                        <i className="pi pi-spinner pi-spin" />
                                    </div>)
                                        :
                                        <ScrollPanel className="w-full bg-white min-h-[100px]">
                                            <ul>
                                                {users.map((user) => (
                                                    <li key={"user-" + user.id}>
                                                        {itemTemplate(user)}
                                                    </li>
                                                ))}
                                                {users.length === 0 &&
                                                    <li className="text-center">
                                                        <p>No users found</p>
                                                    </li>
                                                }
                                            </ul>
                                        </ScrollPanel>
                                    }
                                </div>
                            }
                        </div>
                    </div>

                </Card>
                {menuItems.map((menuItems1, i) => (
                    <Card key={"menu-items-" + i}>
                        <div className="grid max-[400px]:grid-cols-2 grid-cols-4 items-center gap-1 gap-5 justify-between" >
                            {menuItems1.map(item =>
                                <Link href={item.url} className="cursor-pointer" key={item.label + "-menu-item"}>
                                    <div className="flex flex-col w-full justify-center hover:shadow transition-all hover:scale-105 rounded-lg items-center h-max cursor-pointer p-1 sm:px-4 sm:py-2.5 border gap-2">
                                        <div className="h-8 w-8 sm:h-14 sm:w-14">
                                            {item.icon}
                                        </div>
                                        <span className="text-xs font-medium sm:font-bold">{item.label}</span>
                                    </div>
                                </Link>
                            )}
                        </div>
                    </Card>
                ))}
            </div>

        </DashboardLayout>
    );
}
