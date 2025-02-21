import { PaginatedCollection } from '@/types';
import { motion } from "motion/react"
import { ChatData, MessageData } from '@/types/_generated';
import { usePage } from '@inertiajs/react';
import Message from './Message';
import { cn, poll } from '@/utils';
import { throttle } from 'lodash';
import MessageDate from './MessageDate';

export default function Messages({
    messages,
    setMessages,
    inSidebar
}: {
    messages: PaginatedCollection<MessageData>
    setMessages: (messages: PaginatedCollection<MessageData>) => void
    inSidebar?: boolean
}) {
    const chat = usePage().props.chat as ChatData;
    const { isTyping, setIsTyping } = useTyping(chat);
    const messageContainerRef = useRef<HTMLDivElement>(null);
    const { scrollToBottom } = useScrollRestoration(messageContainerRef, 'message-container-scroll');
    const [newMessageCount, setNewMessageCount] = useState(0);
    const updateMessages = throttle(async () => {
        const res = await fetch(route('messages.get-new', { chat: chat.uuid }))
        const data = await res.json()
        if (data.messages) {
            setMessages(data.messages as PaginatedCollection<MessageData>);
            setNewMessageCount(0);
        }
    }, 1000)

    useEffect(() => {
        scrollToBottom();
    }, [JSON.stringify(messages)]);

    useEffect(() => {
        if (isTyping) {
            scrollToBottom();
        }
    }, [isTyping]);

    return (
        <>
            {newMessageCount > 0 && (
                <div className="absolute bottom-32 z-20 left-0 w-full flex items-center justify-center">
                    <motion.div
                        role='button'
                        onClick={updateMessages}
                        initial={{ opacity: 0, y: 50 }}
                        transition={{ duration: 0.3 }}
                        animate={{ opacity: 1, y: 0 }}
                        className="bg-primary rounded shadow gap-2 inline-flex p-2 text-white font-bold items-center justify-center">
                        <span>{newMessageCount} New messages</span>
                        <i className="pi pi-arrow-down text-sm"></i>
                    </motion.div>
                </div>
            )}
            <div className={cn("content", inSidebar ? "!h-full" : "!h-full")} ref={messageContainerRef}>
                <div className="flex flex-col-reverse w-full px-4 relative" >
                    <div className='h-[150px] w-full'></div>
                    {!messages?.data ? (
                        <div className="flex flex-col items-center justify-center w-full h-full gap-2">
                            <i className="ti-comments text-xl sm:text-3xl"></i>
                            <p className='text-xl font-bold text-center'>
                                Seems people are shy to start the chat. Break the ice
                                send the first message.
                            </p>
                        </div>
                    ) : <>
                        {isTyping && <div className="message">
                            <img className="avatar-md" src={chat.from?.avatar} data-toggle="tooltip" data-placement="top" title="" alt="avatar" data-original-title={chat.from?.avatar} />
                            <div className="text-main">
                                <div className="text-group">
                                    <div className="text typing">
                                        <div className="wave">
                                            <span className="dot"></span>
                                            <span className="dot"></span>
                                            <span className="dot"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>}
                        {(messages.data?.map((message, i) => (
                            <>
                                <Message message={message}>
                                    {i > 0 && <MessageDate date={message.created_at} prev={messages.data[i + 1]?.created_at} />}
                                </Message>
                                {i === 0 && <MessageDate date={message.created_at} prev={messages.data[i + 1]?.created_at} />}
                            </>

                        )))}
                    </>
                    }
                </div>

            </div >
        </>
    )
}
