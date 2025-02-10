import useBreakpoint from "@/Hooks/useBrakpoints";
import { PaginatedCollection } from "@/types";
import { ChatData, MessageData } from "@/types/_generated";
import { Button } from "primereact/button";
import { Sidebar } from "primereact/sidebar";

export default function RequestMoneyChatList({ chat }: { chat: ChatData }) {
    const [visible, setVisible] = useState(false);
    const [messages, setMessages] = useState<PaginatedCollection<MessageData>>();
    const { max } = useBreakpoint()

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
            <Button rounded size={max('sm') ? 'small' : 'large'} className="!rounded-lg flex items-center !p-2 h-10 w-10 sm:h-12 sm:w-12" title="Request Money" onClick={() => setVisible(true)}>
                <HugeiconsMoneyReceiveCircle className="w-full h-full" />
            </Button>
            <Sidebar pt={{
                header: {
                    className: "bg-white"
                }
            }} visible={visible} position="right" header={
                <div className="font-bold text-lg">Request Money</div>
            } className="w-[380px] sm:w-[420px] bg-base-gradient" onHide={() => setVisible(false)}>
                <div className="my-4">
                    <RequestMoney chat={chat} />
                </div>
                <div className="my-4">
                    {messages && <Messages inSidebar={true} messages={messages} setMessages={setMessages} />}
                </div>
            </Sidebar>
        </>
    )
}
