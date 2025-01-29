import { PaginatedCollection } from "@/types";
import { ChatData, MessageData } from "@/types/_generated";
import { Button } from "primereact/button";
import { Sidebar } from "primereact/sidebar";

export default function RequestMoneyChatList({ chat }: { chat: ChatData }) {
    const [visible, setVisible] = useState(false);
    const [messages, setMessages] = useState<PaginatedCollection<MessageData>>();

    useEffect(() => {
        const fetchMessages = async () => {
            const res = await fetch(route('messages.money-requests', { chat: chat.uuid }))
            const data = await res.json()
            if (data.messages) {
                setMessages(data.messages as PaginatedCollection<MessageData>);
            }
        }
        fetchMessages()
    }, [])
    return (
        <>
            <Button outlined text rounded className="!rounded-lg" title="Request Money List" onClick={() => setVisible(true)}>
                <HugeiconsRightToLeftListDash className="h-6 w-6" />
            </Button>
            <Sidebar pt={{
                header: {
                    className: "bg-white"
                }
            }} visible={visible} position="right" header={
                <div className="font-bold text-lg">Request Money List</div>
            } className="w-[380px] sm:w-[500px] bg-base-gradient" onHide={() => setVisible(false)}>
                <div>
                    {messages && <Messages inSidebar={true} messages={messages} setMessages={setMessages} />}
                </div>
            </Sidebar>
        </>
    )
}
