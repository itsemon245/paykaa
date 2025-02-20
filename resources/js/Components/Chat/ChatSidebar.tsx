import { Echo } from "@/echo";
import { PaginatedCollection } from "@/types";
import { ChatData, MessageData } from "@/types/_generated";
import { cn, defaultAvatar, image } from "@/utils";
import { Link, usePage } from "@inertiajs/react";

export default function ChatSidebar({
    chats,
    setChats,
    fetchChats
}: {
    chats: PaginatedCollection<ChatData>,
    setChats: (chats: PaginatedCollection<ChatData>) => void
    fetchChats: (search?: string) => void
}) {
    const [searchString, setSearchString] = useState("");
    const chat = usePage().props.chat as ChatData | undefined;
    const { user } = useAuth();
    const itemTemplate = (item: ChatData, key?: any) => {
        return (<Link
            href={route('chat.show', { chat: item.uuid })}
            key={key}
            className={`filterDiscussions all unread single ${item.uuid === chat?.uuid ? 'active' : ''}`}
        >
            <img
                className="avatar-md"
                src={image(item.from?.avatar)}
                onError={(e) => {
                    //@ts-ignore
                    e.target.src = defaultAvatar
                }}
                data-toggle="tooltip"
                data-placement="top"
                title={item.from?.name}
                alt={item.from?.name + "'s avatar"}
            />
            {/* <div className="status online"></div> */}

            <div className="data">
                <h5>{item.from?.name}</h5>
                {/*
                <div className="new bg-yellow">
                    <span>5+</span>
                </div>
                */}
                <span className={cn(
                    item.last_message && !item.last_message?.by_me && !item.last_message?.is_read && "!font-bold !text-black",
                )}>{item.last_message?.created_at_human}</span>
                {item.is_typing ? <div className="flex items-center gap-1 text-sm text-green-500 font-bold">
                    <div>Typing</div>
                    <SvgSpinners3DotsBounce className="w-6 h-4" />
                </div> : (
                    item.last_message ?
                        (
                            <div className="text-ellipsis text-nowrap overflow-hidden flex items-center gap-2">
                                {item.last_message.by_me && <div className="font-medium">You:</div>}
                                <div className={cn(
                                    "!max-w-[200px] overflow-hidden text-ellipsis whitespace-nowrap",
                                    !item.last_message.by_me && !item.last_message.is_read && "!font-bold !text-black",

                                )}>{item.last_message.body}</div>
                            </div>
                        ) :
                        <p>No messages yet</p>
                )}
            </div>
        </Link>
        )
    }

    useEffect(() => {
        if (!chats) return
        const newChatChannel = 'new-chat.' + user.id
        Echo.leave(newChatChannel)
        Echo.channel(newChatChannel)
            .listen('ChatCreated', (e: { chat: ChatData }) => {
                console.log("New chat arrived:", e.chat)
                setChats({
                    ...chats,
                    data: [e.chat, ...chats.data],
                })
            })
        return () => Echo.leave(newChatChannel)
    }, [chats]);
    useEffect(() => {
        if (searchString) {
            fetchChats(searchString);
        }
    }, [searchString]);

    return (
        <div className="sidebar" id="sidebar">
            <div className="h-full px-3 md:px-5">
                <div id="discussions" className="tab-pane flex flex-col fade in active show">
                    <div className="flex items-center justify-center gap-3">
                        <Link href={route('dashboard')} className="me-auto">
                            <button className="!bg-gray-200 !rounded-full w-9 h-9 flex items-center justify-center" title="Back">
                                <i className="ti-angle-left fw-bold !text-gray-800"></i>
                            </button>
                        </Link>
                        <Link href={route('dashboard')} className="flex items-center justify-center gap-5 me-auto">
                            <Logo className="!h-10 w-auto" />
                        </Link>
                    </div>
                    {(!route().current('helpline') || user.id === 1) && <div className="search relative">
                        <form className="form-inline position-relative">
                            <input
                                type="search"
                                onChange={e => setSearchString(e.target.value)}
                                className="form-control"
                                id="conversations"
                                placeholder="Search for conversations..."
                            />
                            <button type="button" className="btn btn-link loop">
                                <i className="ti-search"></i>
                            </button>
                        </form>
                        <AddNewChat />
                    </div>
                    }
                    {/*
                    <div className="flex items-center gap-3 sort pb-0">
                        <button
                            className="btn filterDiscussionsBtn active show"
                            data-toggle="list"
                            data-filter="all"
                        >
                            All
                        </button>
                        <button
                            className="btn filterDiscussionsBtn"
                            data-toggle="list"
                            data-filter="read"
                        >
                            Favourit
                        </button>
                        <button
                            className="btn filterDiscussionsBtn"
                            data-toggle="list"
                            data-filter="unread"
                        >
                            Unread
                        </button>
                    </div>*/}
                    <div className="discussions mt-3">
                        <h1>Chats</h1>
                        {/*                                <div className="btn-group add-group mt-3" role="group">
                            <button
                                id="btnGroupDrop2"
                                type="button"
                                className="btn btn-secondary dropdown-toggle"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                            >
                                Add +
                            </button>
                            <div
                                className="dropdown-menu"
                                aria-labelledby="btnGroupDrop1"
                            >
                                <a className="dropdown-item" href="#">New user</a>
                                <a className="dropdown-item" href="#">New Group +</a>
                                <a className="dropdown-item" href="#">Private Chat +</a>
                            </div>
                        </div>
*/}
                    </div>
                    <div className="discussions h-[700px] hide-scrollbar overflow-y-scroll my-2" id="scroller">
                        <div className="list-group px-0" id="chats" role="tablist">
                            {chats?.data.map(item => itemTemplate(item, "chat-" + item.uuid))}
                            {chats?.data.length === 0 && <div className="flex items-center justify-center gap-3 mt-10">
                                <div>No chats yet</div>
                            </div>}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}
