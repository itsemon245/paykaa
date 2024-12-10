import DashboardLayout from "@/Layouts/DashboarLayout";
import { UserData } from "@/types/_generated";
import { Link } from "@inertiajs/react";
import { Button } from "primereact/button";
import { Card } from "primereact/card";
import { InputText } from "primereact/inputtext";
import { ScrollPanel } from "primereact/scrollpanel";

interface MenuItem {
    label: string;
    icon: React.ReactNode;
    url: string;
    className?: string;
}
export default function Dashboard() {
    const [searchString, setSearchString] = useState("");
    const [filteredUsers, setFilteredUsers] = useState<UserData[]>([]);
    const [loading, setLoading] = useState(false);
    const menuItems1: MenuItem[] = [
        {
            label: "Deposit",
            icon: <HugeiconsWalletAdd01 className="w-full h-full" />,
            url: "#",
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
    const search = async (e: any) => {
        if (e.target.value.length < 2) return;
        setLoading(true);
        setSearchString(e.target.value);
        const response = await fetch(route("search-users", { search: searchString }), {
            method: "get",
            headers: {
                "Content-Type": "application/json",
            },
        })
        const data = await response.json();
        setFilteredUsers(data);
        setLoading(false);
    }
    const itemTemplate = (item: UserData) => {
        return (
            <Link href={route('profile.edit')} className="flex items-center p-3 h-max cursor-pointer">
                <img
                    alt={item.name}
                    src={item.avatar}
                    className="rounded-full w-10 me-2"
                />
                <div className="flex flex-col items-start select-none *:cursor-pointer">
                    <label className="font-bold mb-0 leading-none">{item.name}</label>
                    <label className="text-sm text-gray-500 mb-0">{item.email}</label>
                </div>
            </Link>
        );
    };
    return (
        <DashboardLayout>
            <Head title="Dashboard" />
            <div className="md:pt-20" />
            <div className="flex flex-col gap-3 sm:gap-6">
                <Card>
                    <div className="flex items-start justify-between gap-2 sm:gap-5 max-[320px]:flex-wrap">
                        <Link href={route('chats')} className="flex max-[320px]:w-full items-center h-max cursor-pointer">
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
                        </div>
                    </div>

                    {(filteredUsers.length > 0) &&
                        <div className="rounded-md border-gray-200 mt-2 shadow">
                            {loading && <div className="flex justify-center items-center p-3">
                                <i className="pi pi-spinner pi-spin" />
                            </div>}
                            {!loading &&
                                <ScrollPanel className="w-full bg-white h-40">
                                    <ul>

                                        {filteredUsers.map((user, i) => (
                                            <li key={i}>
                                                {itemTemplate(user)}
                                            </li>
                                        ))}
                                    </ul>
                                </ScrollPanel>
                            }
                        </div>
                    }
                </Card>
                {menuItems.map((menuItems1, i) => (<Card>
                    <div className="grid max-[400px]:grid-cols-2 grid-cols-4 items-center gap-1 gap-5 justify-between">
                        {menuItems1.map(item =>
                            <Link href={item.url} className="cursor-pointer">
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
