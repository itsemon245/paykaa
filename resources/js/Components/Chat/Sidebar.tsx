import { PaginatedCollection } from "@/types";
import { ChatData, UserData } from "@/types/_generated";
import { poll } from "@/utils";
import { Link, useForm, usePage } from "@inertiajs/react";
import { Button } from "primereact/button";
import { Dialog } from "primereact/dialog";
import { ScrollPanel } from "primereact/scrollpanel";
import toast from "react-hot-toast";

export default function Sidebar() {
    const [chats, setChats] = useState<PaginatedCollection<ChatData>>();
    const chat = usePage().props.chat as ChatData;
    const { playSound } = useNotification();
    const fetchChats = async () => {
        const response = await fetch(route('chat.user-chats'));
        const data: PaginatedCollection<ChatData> = await response.json();
        setChats(data);
    };
    const checkForNewMessagesInChats = async () => {
        const res = await fetch(route('chat.check-new-messages', { chat: chat?.uuid }));
        const data = await res.json() as { success: boolean, chat?: ChatData }
        // if (data.success) {
        fetchChats();
        // playSound()
        // }
    };
    const itemTemplate = (item: ChatData, key?: any) => {
        return (<Link
            href={route('chat.show', { chat: item.uuid })}
            key={key}
            className={`filterDiscussions all unread single ${item.uuid === chat.uuid ? 'active' : ''}`}
        >
            <img
                className="avatar-md"
                src={item.from?.avatar}
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
                <span>{item.last_message?.created_at_human}</span>
                {item.is_typing ? <div className="flex items-center gap-1 text-sm text-green-500 font-bold">
                    <div>Typing</div>
                    <SvgSpinners3DotsBounce className="w-6 h-4" />
                </div> : (
                    item.last_message ?
                        (
                            <div className="text-ellipsis text-nowrap overflow-hidden flex items-center gap-2">
                                {item.last_message.by_me && <div className="font-medium">You:</div>}
                                <div>{item.last_message.body}</div>
                            </div>
                        ) :
                        <p>No messages yet</p>
                )}
            </div>
        </Link>
        )
    }


    useEffect(() => {
        fetchChats();
        poll(checkForNewMessagesInChats, 1000);
    }, []);
    return (
        <div className="sidebar" id="sidebar">
            <div className="container h-full">
                <div className="col-md-12 h-full px-0">
                    <div className="tab-content h-full">
                        <div id="discussions" className="tab-pane flex flex-col fade in active show">
                            <Link href={route('dashboard')} className="flex items-center gap-3">
                                <img
                                    className="avatar-xl"
                                    src={useAuth().user?.avatar}
                                    alt="avatar"
                                />
                                <img src="/assets/logo-long.png" alt="" className="max-w-[160px] grow" />
                            </Link>
                            <div className="search relative">
                                <form className="form-inline position-relative">
                                    <input
                                        type="search"
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}
