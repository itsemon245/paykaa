import { Echo } from "@/echo";
import { PaginatedCollection } from "@/types";
import { ChatData, MessageData, MessageType } from "@/types/_generated";
import { useForm, usePage } from "@inertiajs/react";

export default function Show() {
    const messagesProp = usePage().props.messages as PaginatedCollection<MessageData>;
    const [messages, setMessages] = useState<PaginatedCollection<MessageData>>(messagesProp);
    const chat = usePage().props.chat as ChatData;
    const { playSound } = useNotification();
    const { user } = useAuth();

    useEffect(() => {
        const chatChannel = 'chat.' + chat.id
        console.log("listening to channel for messages:", chatChannel)
        Echo.channel(chatChannel)
            .listen('MessageCreated', (e: { message: MessageData }) => {
                if (e.message.receiver_id === user.id) {
                    e.message.by_me = false
                    // playSound()
                } else {
                    e.message.by_me = true
                }
                console.log("New message arrived:", e.message)
                messages.data.unshift(e.message)
                console.log("messages", messages)
                setMessages(messages)
            })
    }, []);
    return (
        <div className="chat" id="chat1" >
            <Topbar />
            <Messages messages={messages} setMessages={setMessages} />
            <Writer />
        </div>
    )
}

