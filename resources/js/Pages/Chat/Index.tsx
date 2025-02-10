import useBreakpoint from "@/Hooks/useBrakpoints";

export default function Index() {
    const { chats, setChats, fetchChats } = useChat();
    const [isMobile, setIsMobile] = useState(false);
    const { max } = useBreakpoint();
    useEffect(() => {
        setIsMobile(max('md'));
    }, [window.innerWidth]);
    return (
        <>
            {(route().current('chat.index') || !isMobile) && <ChatSidebar chats={chats} setChats={setChats} fetchChats={fetchChats} />}
            <div className={`main h-full ${route().current('chat.show') ? '!right-0' : ''}`}>
                <div className="flex flex-col h-full w-full justify-center items-center">
                    <div className="text-3xl font-bold text-gray-500">
                        Choose a conversation to start chatting
                    </div>
                </div>

                {/*                <div className="chat" id="chat1" >
                    <Topbar />
                    <Messages messages={messages} setMessages={setMessages} />
                    <Writer />
                </div>
*/}
            </div>
        </>

    )
}

