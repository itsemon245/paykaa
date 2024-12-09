import DashboardLayout from "@/Layouts/DashboarLayout";
import { UserData } from "@/types/_generated";
import { Link } from "@inertiajs/react";
import { Button } from "primereact/button";
import { Card } from "primereact/card";
import { InputText } from "primereact/inputtext";
import { ScrollPanel } from "primereact/scrollpanel";

interface MenuItem {
    label: string;
    icon: string;
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
            icon: "pi pi-fw pi-money-bill-stack",
            url: "#",
        },
        {
            label: "Withdraw",
            icon: "pi pi-fw pi-bank",
            url: "#",
        },
        {
            label: "P2P",
            icon: "pi pi-fw pi-exchange",
            url: "#",
        },

    ];
    const menuItems2: MenuItem[] = [
        {
            label: "Refferal",
            icon: "pi pi-fw pi-user-plus",
            url: "#",
        },
        {
            label: "Earn",
            icon: "pi pi-fw pi-coins",
            url: "#",
        },
        {
            label: "Transaction",
            icon: "pi pi-fw pi-list",
            url: "#",
        },
        {
            label: "Help Line",
            icon: "pi pi-fw pi-question-circle",
            url: "#",
        },
    ]
    const search = async (e: any) => {
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
            <Card>
                <div className="flex items-start justify-between gap-2 sm:gap-5 max-[320px]:flex-wrap">
                    <Link href={route('chats')} className="flex items-center h-max cursor-pointer">
                        <div className="flex hover:shadow transition-all hover:scale-105 rounded-lg items-center h-max cursor-pointer sm:px-4 sm:py-2.5 p-2 border gap-3">
                            <HugeiconsBubbleChat className="h-8 w-8 sm:h-14 sm:w-14" />
                            <span className="font-bold sm:text-lg">Chats</span>
                        </div>
                    </Link>

                    <div className="grow">
                        <div className="flex-1 relative">
                            <input placeholder="Search user" className="!py-2.5 !rounded-2xl border-2 w-full border-primary-300 active:border-primary-500" onKeyUp={search} />
                            <button type="submit" className="absolute flex items-center h-full justify-end pe-4 w-full top-0 left-0">
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

        </DashboardLayout>
    );
}
