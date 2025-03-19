import { Echo } from "@/echo";
import { useChatStore } from "@/stores/useChatStore";
import { PaginatedCollection } from "@/types";
import { ChatData, MessageData } from "@/types/_generated";
import { router, usePage } from "@inertiajs/react";
import { throttle } from "lodash";

export default function useChat() {
    const { user } = useAuth();
    const { playSound } = useNotification();
    const impersonating = usePage().props.impersonating;
    const messagesProp = usePage().props.messages as PaginatedCollection<MessageData>;
    const chatsProp = usePage().props.chats as PaginatedCollection<ChatData>;
    const [chats, setChats] = useState<PaginatedCollection<ChatData>>(chatsProp);
    const [messages, setMessages] = useState<PaginatedCollection<MessageData>>(messagesProp);

    const setMessageBody = useChatStore(state => state.setMessageBody);

    const fetchChats = useCallback(throttle(async (search?: string) => {
        const response = await fetch(route('chat.user-chats', { search: search, helpline: route().current('helpline') }));
        const data: PaginatedCollection<ChatData> = await response.json();
        setChats(data);
    }, 500, { leading: false, trailing: true }), [])

    useEffect(() => {
        if (messagesProp) {
            setMessages(messagesProp)
        }
    }, [messagesProp])
    useEffect(() => {
        if (chatsProp) {
            setChats(chatsProp)
        }
    }, [chatsProp])

    useEffect(() => {
        if (!chats) return
        chats.data.forEach(item => {
            const chatChannel = 'chat.' + item.id
            console.log("listening to channel:", chatChannel)
            Echo.leave(chatChannel)
            Echo.channel(chatChannel)
                .listen('MessageCreated', (e: { message: MessageData, authId: number }) => {
                    if (e.authId !== user.id || impersonating?.old) {
                        playSound()
                        router.visit(window.location.href, {
                            preserveState: true,
                            preserveScroll: true,
                            only: ['messages', 'chats'],
                        })
                    }
                    return
                    const newChats = chats.data.map(chat => {
                        if (chat.id === e.message.chat_id) {
                            if (e.message.receiver_id === user.id) {
                                e.message.by_me = false
                                playSound()
                            } else {
                                e.message.by_me = true
                            }
                            //update existing message
                            if (messages.data.find(m => m.id === e.message.id)) {
                                const data = messages.data.map(m => {
                                    if (m.id === e.message.id) {
                                        return e.message
                                    }
                                    return m
                                })
                                setMessages({
                                    ...messages,
                                    data: data,
                                })
                            } else {//add new message
                                messages.data.unshift(e.message)
                                setMessages(messages)
                                return {
                                    ...chat,
                                    last_message: e.message, //add new message to last message
                                }
                            }
                            return chat //return the chat
                        }
                        return chat //return the chat anyways
                    })
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
