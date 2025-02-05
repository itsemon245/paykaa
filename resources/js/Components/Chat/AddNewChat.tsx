import { UserItemTemplate } from "@/Pages/Dashboard/Index";
import { UserData } from "@/types/_generated";
import { Link } from "@inertiajs/react";
import { Button } from "primereact/button";
import { Dialog } from "primereact/dialog";
import { ScrollPanel } from "primereact/scrollpanel";

export default function AddNewChat() {
    const [visible, setVisible] = useState(false);
    const { users, loading, searchString, setSearchString } = useUsers();
    return (<>
        <Button
            className="absolute right-0 top-0 flex items-center justify-end pe-2"
            text
            onClick={() => { setVisible(true) }}
            icon="pi pi-plus"
        >
        </Button>
        <Dialog pt={{
            content: {
                className: 'overflow-y-hidden',
            }
        }} header="Start a new chat" visible={visible} onHide={() => { if (!visible) return; setVisible(false); }}
            className="max-w-3xl min-w-[300px] min-h-[400px] max-h-max z-[100]">
            <div className="relative">
                <div className="form-group relative">
                    <i className="pi pi-search absolute left-4 top-3 text-xl text-primary flex items-center justify-start"></i>
                    <input type="text" onChange={e => setSearchString(e.target.value)} className="form-control" id="topic" placeholder="Search for user" />
                </div>
                {(users.length > 0 && searchString !== "") &&
                    <div className="absolute top-[100%] left-2 rounded-md bg-white border-gray-200 mt-2 shadow w-full !z-[2000]">
                        {loading ? (<div className="flex justify-center items-center p-3 min-w-[300px]">
                            <i className="pi pi-spinner pi-spin" />
                        </div>)
                            :
                            <ul className=" max-h-[300px] overflow-y-auto">
                                {users.map((user) => (
                                    <li key={"user-" + user.id}>
                                        <UserItemTemplate user={user} onSelect={() =>
                                            setVisible(false)
                                        } />
                                    </li>
                                ))}
                                {users.length === 0 &&
                                    <li className="text-center">
                                        <p>No users found</p>
                                    </li>
                                }
                            </ul>
                        }
                    </div>
                }
            </div>
        </Dialog>
    </>)
}
