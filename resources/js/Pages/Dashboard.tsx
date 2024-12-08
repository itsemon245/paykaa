import DashboardLayout from "@/Layouts/DashboarLayout";
import { UserData } from "@/types/_generated";
import { Link } from "@inertiajs/react";
import { Button } from "primereact/button";
import { Card } from "primereact/card";
import { InputText } from "primereact/inputtext";
import { ScrollPanel } from "primereact/scrollpanel";

export default function Dashboard() {
    const [searchString, setSearchString] = useState("");
    const [filteredUsers, setFilteredUsers] = useState<UserData[]>([]);
    const [loading, setLoading] = useState(false);
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
                <div className="flex items-start justify-between gap-5 flex-wrap">
                    <Link href={route('chats')} className="flex items-center h-max cursor-pointer">
                        <div className="flex hover:shadow transition-all hover:scale-105 rounded-lg items-center h-max cursor-pointer px-4 py-2.5 border gap-3">
                            <HugeiconsBubbleChat className="h-14 w-14" />
                            <span className="font-bold text-lg">Chats</span>
                        </div>
                    </Link>

                    <div className="grow">
                        <div className="p-inputgroup flex-1">
                            <InputText placeholder="Search for using name, email, phone or uid" onKeyUp={search} />
                            <Button loading={loading} onClick={search} icon="pi pi-search" className="p-3" size="small" />
                        </div>
                        <small className="text-sm text-gray-500 ml-2 text-wrap">Type @ to search all users since all email has @ in it</small>
                    </div>
                </div>

                <div className="rounded-md border-gray-200 mt-2 shadow">
                    {loading && <div className="flex justify-center items-center p-3">
                        <i className="pi pi-spinner pi-spin" />
                    </div>}
                    {(filteredUsers.length > 0 && !loading) &&
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
            </Card>
        </DashboardLayout>
    );
}
