import SendMoney from '@/Components/SendMoney';
import { usePoll } from '@inertiajs/react'
import menuItems from '@/data/menuItems';
import { UserData } from '@/types/_generated';
import { defaultAvatar, mask } from '@/utils';
import { Link, router, usePage } from '@inertiajs/react';
import { chunk } from 'lodash';
import { Badge } from 'primereact/badge';
import { Card } from 'primereact/card';
import toast from 'react-hot-toast';

export const UserItemTemplate = ({ user, onSelect }: { user: UserData; onSelect?: () => void }) => {
    const handleClick = () => {
        router.visit(route('chat.receiver-chat', { receiver: user.uuid }), {
            onSuccess: () => {
                if (onSelect) {
                    onSelect();
                }
            },
            onError: (error) => {
                console.log('Error while visiting the chat show route', error);
                toast.error('Something went wrong!');
            },
        });
    };
    return (
        <button onClick={handleClick} className="flex h-max w-full cursor-pointer items-center p-2">
            <img
                alt={user.name}
                src={user.avatar}
                onError={(e) => {
                    //@ts-ignore
                    e.target.src = defaultAvatar;
                }}
                className="me-2 w-10 rounded-full"
            />
            <div className="flex select-none flex-col items-start *:cursor-pointer">
                <label className="mb-0 font-bold leading-none">{user.name}</label>
                <label className="mb-0 text-sm text-gray-500">{mask(user.email, '*', 2, 9)}</label>
            </div>
        </button>
    );
};
export default function Dashboard() {
    const { users, loading, searchString, setSearchString, search } = useUsers();
    const unreadCount = usePage().props.unreadCount;
    const menus = chunk(menuItems, 4);

    const [sendMoneyVisible, setSendMoneyVisible] = useState(false);
    const { start, stop } = usePoll(5000, {
        only: ['unreadCount', 'notifications']
    }, {
        autoStart: false
    });

    useEffect(() => {
        if (sendMoneyVisible) {
            stop();
        } else {
            start();
        }
        return stop;
    }, [sendMoneyVisible])


    return (
        <>
            <SendMoney sendMoneyVisible={sendMoneyVisible} setSendMoneyVisible={setSendMoneyVisible} />
            <Head title="Dashboard" />
            <div className="flex flex-col gap-3 sm:gap-6">
                <Card>
                    <div className="grid grid-cols-4 items-center justify-center gap-4 sm:gap-6 md:gap-8">
                        <Link
                            prefetch
                            href={route('chat.index')}
                            className="flex h-max cursor-pointer items-center justify-center">
                            <div className="relative p-2">
                                {unreadCount > 0 && (
                                    <Badge className="absolute right-0 top-0" value={unreadCount}></Badge>
                                )}
                                <img
                                    src="/assets/dashboard/chat.png"
                                    className="h-8 w-8 object-contain sm:h-14 sm:w-14"
                                />
                                <span className="text-xs font-medium sm:text-lg">Chats</span>
                            </div>
                        </Link>

                        <div className="relative col-span-3 max-w-lg grow">
                            <div className="relative flex flex-1 items-center">
                                <input
                                    placeholder="Search user"
                                    className="w-full !rounded-2xl border-2 border-primary-300 py-3 text-sm active:border-primary-500 sm:py-4 sm:text-lg"
                                    onChange={(e) => setSearchString(e.target.value)}
                                />
                                <button
                                    type="submit"
                                    className="absolute right-4 my-auto"
                                    onClick={(e) => search(searchString)}>
                                    <i className="pi pi-search text-primary-500" />
                                </button>
                            </div>
                            {users.length > 0 && searchString !== '' && (
                                <div className="absolute left-2 top-[100%] !z-[2000] mt-2 w-full rounded-md border-gray-200 bg-white shadow">
                                    {loading ? (
                                        <div className="flex min-w-[300px] items-center justify-center p-3">
                                            <i className="pi pi-spinner pi-spin" />
                                        </div>
                                    ) : (
                                        <ul className="max-h-[300px] overflow-y-auto">
                                            {users.map((user) => (
                                                <li key={'user-' + user.id}>
                                                    <UserItemTemplate user={user} />
                                                </li>
                                            ))}
                                            {users.length === 0 && (
                                                <li className="text-center">
                                                    <p>No users found</p>
                                                </li>
                                            )}
                                        </ul>
                                    )}
                                </div>
                            )}
                        </div>
                    </div>
                </Card>
                {menus.map((items, i) => (
                    <Card key={'menu-items-' + i} className="border">
                        <div className="grid grid-cols-4 items-center justify-between gap-2 sm:gap-5">
                            {items.map((item) => (
                                <>
                                    {i === 0 && item.label === 'Earn' ? <button
                                        onClick={() => setSendMoneyVisible(true)}
                                        className="cursor-pointer border-none outline-none">
                                        <div className="flex h-max w-full cursor-pointer flex-col items-center justify-center gap-2 rounded-lg p-1 transition-all hover:scale-105 hover:shadow-md sm:px-4 sm:py-2.5">
                                            <div className="h-8 w-8 sm:h-14 sm:w-14">
                                                <img src="/assets/dashboard/send-money.png" className="h-full w-full object-contain" />
                                            </div>
                                            <span className="text-xs font-medium sm:text-lg sm:font-bold">
                                                Send Money
                                            </span>
                                        </div>
                                    </button> :

                                        <Link
                                            prefetch={['mount', 'hover']}
                                            href={item.url}
                                            className="cursor-pointer"
                                            key={item.label + '-menu-item'}>
                                            <div className="flex h-max w-full cursor-pointer flex-col items-center justify-center gap-2 rounded-lg p-1 transition-all hover:scale-105 hover:shadow-md sm:px-4 sm:py-2.5">
                                                <div className="h-8 w-8 sm:h-14 sm:w-14">
                                                    <img src={item.icon} className="h-full w-full object-contain" />
                                                </div>
                                                <span className="text-xs font-medium sm:text-lg sm:font-bold">
                                                    {item.label}
                                                </span>
                                            </div>
                                        </Link>
                                    }
                                </>))}
                        </div>
                    </Card>
                ))}
            </div>
        </>
    );
}
