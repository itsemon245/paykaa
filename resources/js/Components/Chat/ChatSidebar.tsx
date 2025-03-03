import { Echo } from "@/echo";
import useBreakpoint from "@/Hooks/useBrakpoints";
import { PaginatedCollection } from "@/types";
import { ChatData, MessageData } from "@/types/_generated";
import { cn, defaultAvatar, getQuery, image } from "@/utils";
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
    const { min } = useBreakpoint();
    const chat = usePage().props.chat as ChatData | undefined;
    const { user, isAdmin } = useAuth();
    const itemTemplate = (item: ChatData, key?: any) => {
        return (<Link
            href={route().current('helpline') && !isAdmin ? route('helpline') : route('chat.show', { chat: item.uuid })}
            key={key}
            className={` !py-3 filterDiscussions all unread single ${item.uuid === chat?.uuid ? 'active' : ''}`}
        >
            <img
                className={min('md') ? "avatar-md me-2" : "avatar-sm me-2"}
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
                <div className="text-sm font-bold md:text-lg">{item.from?.name}</div>
                {/*
                <div className="new bg-yellow">
                    <span>5+</span>
                </div>
                */}
                <span className={cn(
                    item.last_message && !item.last_message?.by_me && !item.last_message?.is_read && "!font-bold !text-black",
                )}>{item.last_message?.created_at_human}</span>
                {item.is_typing ? <div className="flex items-center gap-1 text-xs md:text-sm text-green-500 font-bold">
                    <div>Typing</div>
                    <SvgSpinners3DotsBounce className="w-6 h-4" />
                </div> : (
                    item.last_message ?
                        (
                            <div className={cn(
                                "!max-w-[200px] overflow-hidden text-ellipsis whitespace-nowrap flex items-center gap-1 max-md:text-xs",
                                !item.last_message.by_me && !item.last_message.is_read && "!font-bold !text-black",
                            )}>
                                {item.last_message.by_me && <div className="font-medium">You:</div>}
                                {item.last_message.type === 'image' ? <HeroiconsPhoto20Solid className="w-4 h-auto mt-1" /> : item.last_message.body}</div>
                        ) :
                        <p>No messages</p>
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
    // useEffect(() => {
    //     if (searchString) {
    //         fetchChats(searchString);
    //     }
    // }, [searchString]);

    return (
        <div className="sidebar" id="sidebar">
            <div className="h-full px-3 md:px-5">
                <div id="discussions" className="tab-pane flex flex-col fade in active show">
                    <div className="flex items-center justify-center gap-3 relative">
                        <Link href={route('dashboard')} className="me-auto absolute left-4">
                            <button className="!bg-gray-200 !rounded-full w-9 h-9 flex items-center justify-center" title="Back">
                                <i className="ti-angle-left fw-bold !text-gray-800"></i>
                            </button>
                        </Link>
                        <Link href={route('dashboard')} className="flex items-center justify-center gap-5">
                            <Logo className="!h-10 w-auto" />
                        </Link>
                    </div>
                    {(!route().current('helpline') || user.id === 1) && <div className="search relative">
                        <form className="form-inline position-relative">
                            <input
                                type="search"
                                onChange={e => fetchChats(e.target.value)}
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
                    <div className="discussions mt-3 flex justify-between items-center">
                        <h1>Chats</h1>
                        {(!route().current('helpline') || user.id === 1) && <div className="flex items-center gap-3 sort pb-0">
                            <Link
                                className={cn("btn filterDiscussionsBtn", getQuery('search') !== 'unread' ? 'active' : '')}
                                data-toggle="list"
                                data-filter="unread"
                                replace
                                href={route('chat.index', { search: '' })}
                            >
                                All
                            </Link>
                            {/*
                                                            <button
                                className="btn filterDiscussionsBtn"
                                data-toggle="list"
                                data-filter="read"
                            >
                                Favourite
                            </button>
                            */}
                            <Link
                                className={cn("btn filterDiscussionsBtn", getQuery('search') === 'unread' ? 'active' : '')}
                                data-toggle="list"
                                data-filter="unread"
                                replace
                                href={route('chat.index', { search: 'unread' })}
                            >
                                Unread
                            </Link>
                        </div>}
                    </div>
                    <div className="discussions h-[700px] hide-scrollbar overflow-y-scroll my-2" id="scroller">
                        <div className="list-group px-0" id="chats" role="tablist">
                            {chats?.data.map(item => itemTemplate(item, "chat-" + item.uuid))}
                            {chats?.data.length === 0 && <div className="flex items-center justify-center gap-3 mt-10">
                                <div>No chats</div>
                            </div>}
                        </div>
                    </div>
                </div>
            </div>
        </div >
    )
}
