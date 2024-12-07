import DashboardLayout from "@/Layouts/DashboarLayout";
import { Link } from "@inertiajs/react";
import { AutoComplete } from "primereact/autocomplete";
import { Card } from "primereact/card";
import { InputText } from "primereact/inputtext";
import { OrderList } from "primereact/orderlist";
import { VirtualScroller } from "primereact/virtualscroller";

interface User {
    name: string;
    image: string;
    username: string;
    id: number;
    email: string;
    phone: string;
}
export default function Dashboard() {
    const [searchString, setSearchString] = useState("");
    const [filteredUsers, setFilteredUsers] = useState<User[]>([]);
    const [loading, setLoading] = useState(false);
    const search = (event: any) => {
        setLoading(true);
        setTimeout(() => {
            const _filteredUsers: User[] = [
                {
                    name: "John Smith",
                    image: "https://primefaces.org/cdn/primevue/images/avatar/large/nicole.jpg",
                    username: "john",
                    id: 112202,
                    email: "john@example.com",
                    phone: "555-123-4567",
                },
                {
                    name: "Jane Doe",
                    image: "https://primefaces.org/cdn/primevue/images/avatar/large/alex.jpg",
                    username: "jane",
                    id: 122202,
                    email: "jane@example.com",
                    phone: "555-234-5678",
                },
            ]
            setFilteredUsers(_filteredUsers);
            setLoading(false);
        }, 1500);

    }
    const itemTemplate = (item: User) => {
        return (
            <Link href={route('profile.edit')} className="flex align-items-center">
                <img
                    alt={item.name}
                    src={item.image}
                    className="rounded-full w-8 h-8 me-2"
                    style={{ width: '18px' }}
                />
                <div>{item.name}</div>
            </Link>
        );
    };
    return (
        <DashboardLayout>
            <Head title="Dashboard" />
            <Card>
                <InputText placeholder="Search for users" value={searchString} onChange={search} />
                <div className="rounded-md border-gray-200 mt-2 shadow">
                    <ul>
                        {filteredUsers.map((user, i) => (
                            <li key={i}>
                                {itemTemplate(user)}
                            </li>
                        ))}
                    </ul>
                </div>
            </Card>
        </DashboardLayout>
    );
}
