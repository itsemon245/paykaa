import { PaginatedCollection } from "@/types";
import { ChatData } from "@/types/_generated";
import { Link, useForm } from "@inertiajs/react";

export default function Sidebar() {
    const [chats, setChats] = useState<PaginatedCollection<ChatData>>();
    const form = useForm()
    const fetchChats = async () => {
        const response = await fetch(route('chat.user-chats'));
        const data: PaginatedCollection<ChatData> = await response.json();
        setChats(data);
    };
    const itemTemplate = (chat: ChatData) => {
        return (<Link
            href={route('chat.show', { chat: chat.uuid })}
            className="filterDiscussions all unread single active"
        >
            <img
                className="avatar-md"
                src={chat.receiver?.avatar}
                data-toggle="tooltip"
                data-placement="top"
                title={chat.receiver?.name}
                alt={chat.receiver?.name + "'s avatar"}
            />
            {/* <div className="status online"></div> */}

            <div className="data">
                <h5>{chat.receiver?.name}</h5>
                {/*
                <div className="new bg-yellow">
                    <span>5+</span>
                </div>
                */}
                <span>{chat.last_message?.created_at_human}</span>
                {chat.last_message ?
                    (
                        <div>
                            {chat.last_message.body}
                        </div>
                    ) :
                    <p>No messages yet</p>
                }
            </div>
        </Link>
        )
    }



    useEffect(() => {
        fetchChats();
    }, []);
    return (
        <div className="sidebar" id="sidebar">
            <div className="container h-full">
                <div className="col-md-12 h-full px-0">
                    <div className="tab-content h-full">
                        <div id="discussions" className="tab-pane flex flex-col fade in active show">
                            <div className="flex items-center gap-3">
                                <img
                                    className="avatar-xl"
                                    src="/assets/chat/img/avatars/avatar-male-1.jpg"
                                    alt="avatar"
                                />
                                <img src="/assets/chat/img/logo.png" alt=""
                                />
                            </div>
                            <div className="search">
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
                                <button
                                    className="btn create"
                                    data-toggle="modal"
                                    data-target="#startnewchat"
                                >
                                    <i className="ti-pencil"></i>
                                </button>
                            </div>
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
                            </div>
                            <div className="discussions mt-3">
                                <h1>Chats</h1>
                                <div className="btn-group add-group mt-3" role="group">
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
                            </div>
                            <div className="discussions h-[700px] hide-scrollbar overflow-y-scroll my-2" id="scroller">
                                <div className="list-group px-0" id="chats" role="tablist">
                                    {chats?.data.map(item => itemTemplate(item))}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}
