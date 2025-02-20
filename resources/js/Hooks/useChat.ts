import { Echo } from "@/echo";
import { PaginatedCollection } from "@/types";
import { ChatData, MessageData } from "@/types/_generated";
import { usePage } from "@inertiajs/react";
import { throttle } from "lodash";

export default function useChat() {
    const { user } = useAuth();
    const { playSound } = useNotification();
    const messagesProp = usePage().props.messages as PaginatedCollection<MessageData>;
    const chatsProp = usePage().props.chats as PaginatedCollection<ChatData>;
    const [chats, setChats] = useState<PaginatedCollection<ChatData>>(chatsProp);
    const [messages, setMessages] = useState<PaginatedCollection<MessageData>>(messagesProp);

    const fetchChats = useCallback(throttle(async (search?: string) => {
        const response = await fetch(route('chat.user-chats', { search: search }));
        const data: PaginatedCollection<ChatData> = await response.json();
        setChats(data);
    }, 500, { leading: false, trailing: true }), [])

    useEffect(() => {
        if (messagesProp) {
            setMessages(messagesProp)
        }
    }, [messagesProp])

    useEffect(() => {
        if (!chats) return
        chats.data.forEach(item => {
            const chatChannel = 'chat.' + item.id
            console.log("listening to channel:", chatChannel)
            Echo.leave(chatChannel)
            Echo.channel(chatChannel)
                .listen('MessageCreated', (e: { message: MessageData }) => {
                    console.log("New message arrived:", e.message)
                    const newChats = chats.data.map(chat => {
                        if (chat.id === e.message.chat_id) {
                            if (e.message.receiver_id === user.id) {
                                e.message.by_me = false
                            } else {
                                e.message.by_me = true
                            }
                            messages.data.unshift(e.message)
                            console.log("messages", messages)
                            setMessages(messages)
                            if (!e.message.by_me) {
                                playSound()
                            }
                            return {
                                ...chat,
                                last_message: e.message,
                            }
                        }
                        return chat
                    })
                    console.log("new chats", newChats)
                    setChats({
                        ...chats,
                        data: newChats,
                    })
                })
        })
        return () => Echo.leaveAllChannels()
    }, [chats?.data.length])

    return {
        chats,
        setChats,
        messages,
        setMessages,
        fetchChats,
    }
}
