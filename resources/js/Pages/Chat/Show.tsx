import useBreakpoint from "@/Hooks/useBrakpoints";
import { PaginatedCollection } from "@/types";
import { MessageData } from "@/types/_generated";

export default function Show() {
    const { chats, setChats, messages, setMessages, fetchChats } = useChat();
    const [isMobile, setIsMobile] = useState(false);
    const { max } = useBreakpoint();
    useEffect(() => {
        setIsMobile(max('md'));
    }, [window.innerWidth]);

    return (
        <>
            {(route().current('chat.index') || !isMobile) && <ChatSidebar chats={chats} setChats={setChats} fetchChats={fetchChats} />}
            <div className={`main h-full ${route().current('chat.show') ? '!right-0' : ''}`}>
                <div className="chat" id="chat1" >
                    <Topbar />
                    <Messages messages={messages} setMessages={setMessages} />
                    <Writer />
                </div>
            </div>
        </>
    )
}

