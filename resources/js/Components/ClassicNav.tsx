import useBreakpoint from '@/Hooks/useBrakpoints';
import { UserItemTemplate } from '@/Pages/Dashboard/Index';
import { RouteName } from '@/types';
import { cn } from '@/utils';
import { Link } from '@inertiajs/react';
import { Button } from 'primereact/button'
import { InputText } from 'primereact/inputtext'
import { ScrollPanel } from 'primereact/scrollpanel';
import { Sidebar } from 'primereact/sidebar';


interface NavLink {
    label: string;
    route: RouteName;
}

export default function ClassicNav({ only }: { only?: string[] }) {
    const { users, loading, searchString, setSearchString, search } = useUsers();
    const navLinks: NavLink[] = [
        {
            label: "Home",
            route: "dashboard",
        },
        {
            label: "P2P",
            route: "marketplace.index",
        },
        {
            label: "Ads",
            route: "add.index",
        },
        {
            label: "Chat",
            route: "chat.index",
        },
        {
            label: "Refer",
            route: "referrals.index",
        },
        {
            label: "Earn",
            route: "earnings.index",
        },
        {
            label: "Account",
            route: "profile.edit",
        },
    ]
    const { min, max } = useBreakpoint()
    const [visibleRight, setVisibleRight] = useState(false);
    return (
        <div className="flex max-sm:gap-8 sm:grid sm:grid-cols-2 justify-center py-4 px-3 items-center">
            <div className="flex justify-center">
                <Logo className="!w-28 sm:h-8 sm:w-auto object-contain" />
            </div>
            <div className="flex gap-3 items-center justify-between lg:grid lg:grid-cols-2 lg:justify-center">
                <div className="lg:w-[80%] relative">
                    <div className="flex">
                        <InputText placeholder="Search" className="rounded-r-none" onChange={e => setSearchString(e.target.value)} />
                        <button className="p-button rounded-l-none w-max !px-2" onClick={e => search(searchString)}>
                            {!max(500) ? "Search" : <i className="pi pi-search text-xl font-bold" />}
                        </button>
                    </div>
                    {(users.length > 0 && searchString !== "") &&
                        <div className="absolute top-[100%] left-2 rounded-md bg-white border-gray-200 mt-2 shadow w-full !z-[2000]">
                            {loading ? (<div className="flex justify-center items-center p-3 min-w-[300px]">
                                <i className="pi pi-spinner pi-spin" />
                            </div>)
                                :
                                <ul className=" max-h-[300px] overflow-y-auto">
                                    {users.map((user) => (
                                        <li key={"user-" + user.id} >
                                            <UserItemTemplate user={user} />
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

                <button onClick={() => setVisibleRight(true)} className="flex lg:hidden h-10 w-10 items-center justify-center text-gray-100">
                    <i className="pi pi-bars text-xl font-bold" />
                </button>
                <Sidebar header={<Logo className="!w-28 sm:h-8 sm:w-auto object-contain" />} visible={visibleRight} position="right" onHide={() => setVisibleRight(false)}>
                    <ul className='w-full flex flex-col gap-2'>
                        {navLinks.map((item, index) => {
                            if (only) {
                                if (only.includes(item.label)) {
                                    return <li key={index} className="w-full block">
                                        <Link prefetch={['mount', 'hover']} className={cn("transition-all duration-300 px-3 py-1.5 rounded hover:bg-gray-100 block !w-full *:w-full", route().current(item.route) ? "bg-gray-200" : '')} href={route(item.route)}>
                                            {item.label}
                                        </Link>
                                    </li>
                                }
                                return null;
                            }
                            return <li key={index} className="w-full block">
                                <Link prefetch={['mount', 'hover']} className={cn("transition-all duration-300 px-3 py-1.5 rounded hover:bg-gray-100 block !w-full *:w-full", route().current(item.route) ? "bg-gray-200" : '')} href={route(item.route)}>
                                    {item.label}
                                </Link>
                            </li>
                        })}
                    </ul>
                </Sidebar>
                <ul className="hidden mb-0 items-center gap-1 text-gray-100 font-bold lg:flex">
                    {navLinks.map((item, index) => (
                        <li key={index}>
                            <Link prefetch className={cn("transition-all duration-300 px-2 py-1.5 rounded hover:bg-primary-400", route().current(item.route) ? "bg-primary-400" : '')} href={route(item.route)}>
                                {item.label}
                            </Link>
                        </li>
                    ))}
                </ul>
            </div>
        </div>
    )
}
