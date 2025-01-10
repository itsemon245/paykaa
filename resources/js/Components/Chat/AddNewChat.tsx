import { UserData } from "@/types/_generated";
import { Link } from "@inertiajs/react";
import { Button } from "primereact/button";
import { Dialog } from "primereact/dialog";
import { ScrollPanel } from "primereact/scrollpanel";

export default function AddNewChat() {
    const [visible, setVisible] = useState(false);
    const { users, loading, searchString, search } = useUsers();
    const userItemTemplate = (user: UserData) => {
        return (
            <Link href={route('chat.receiver-chat', { receiver: user.uuid })} preserveState={false} preserveScroll={true} onSuccess={() => setVisible(false)} className="flex items-center p-3 h-max cursor-pointer">
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
    return (<>
        <Button
            className="absolute right-0 top-0 flex items-center justify-end pe-2"
            text
            onClick={() => { setVisible(true) }}
            icon="pi pi-plus"
        >
        </Button>
        <Dialog header="Start a new chat" visible={visible} onHide={() => { if (!visible) return; setVisible(false); }}
            className="max-w-max min-w-[300px] min-h-[400px]">
            <div className="form-group relative">
                <i className="pi pi-search absolute left-4 top-3 text-xl text-primary flex items-center justify-start"></i>
                <input type="text" onKeyUp={search} className="form-control" id="topic" placeholder="Search for user" />
            </div>
            {(users.length > 0 && searchString !== "") &&
                <div className="rounded-md border-gray-200 mt-2 shadow">
                    {loading ? (<div className="flex justify-center items-center p-3">
                        <i className="pi pi-spinner pi-spin" />
                    </div>)
                        :
                        <ScrollPanel className="w-full bg-white h-[150px]">
                            <ul>
                                {users.map((user) => (
                                    <li key={"user-" + user.id}>
                                        {userItemTemplate(user)}
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
        </Dialog>
    </>)
}
