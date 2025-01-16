import menuItems from "@/data/menuItems";
import { UserData } from "@/types/_generated";
import { Link } from "@inertiajs/react";
import { chunk } from "lodash";
import { Card } from "primereact/card";
import { ScrollPanel } from "primereact/scrollpanel";

export const UserItemTemplate = ({ user }: { user: UserData }) => {
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
export default function Dashboard() {
    const { users, loading, searchString, search } = useUsers();
    const menus = chunk(menuItems, 4);
    return (
        <>
            <Head title="Dashboard" />
            <div className="flex flex-col gap-3 sm:gap-6">
                <Card>
                    <div className="grid grid-cols-4 gap-4 sm:gap-6 md:gap-8 items-center justify-center ">
                        <Link href={route('chat.index')} className="flex items-center justify-center h-max cursor-pointer">
                            <div className="p-2">
                                <img src="/assets/dashboard/chat.png" className="object-contain h-8 w-8 sm:h-14 sm:w-14" />
                                <span className="font-medium text-xs sm:text-lg">Chats</span>
                            </div>
                        </Link>

                        <div className="grow max-w-lg col-span-3">
                            <div className="flex-1 relative flex items-center">
                                <input placeholder="Search user" className="py-3 text-sm sm:text-lg sm:py-4 !rounded-2xl border-2 w-full border-primary-300 active:border-primary-500" onKeyUp={search} />
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
                                                        <UserItemTemplate user={user} />
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
                {menus.map((items, i) => (
                    <Card key={"menu-items-" + i} className="border">
                        <div className="grid grid-cols-4 items-center gap-2 sm:gap-5 justify-between" >
                            {items.map(item =>
                                <Link href={item.url} className="cursor-pointer" key={item.label + "-menu-item"}>
                                    <div className="flex flex-col w-full justify-center hover:shadow-md transition-all hover:scale-105 rounded-lg items-center h-max cursor-pointer p-1 sm:px-4 sm:py-2.5 gap-2">
                                        <div className="h-8 w-8 sm:h-14 sm:w-14">
                                            <img src={item.icon} className="object-contain w-full h-full" />
                                        </div>
                                        <span className="text-xs sm:text-lg font-medium sm:font-bold">{item.label}</span>
                                    </div>
                                </Link>
                            )}
                        </div>
                    </Card>
                ))}
            </div>
        </>
    );
}
