import useBreakpoint from "@/Hooks/useBrakpoints";
import { useMessageStore } from "@/stores/useMessageStore";
import { ChatData, MessageData } from "@/types/_generated"
import { cn, defaultAvatar, image } from "@/utils";
import { usePage } from "@inertiajs/react";
import { format, parseISO } from "date-fns"

const Message = ({ message, children }: { message: MessageData, children?: React.ReactNode }) => {
    const chat = usePage().props.chat as ChatData;
    const { min } = useBreakpoint();
    const { user } = useAuth()
    const messageRef = useRef<HTMLDivElement>(null)
    if (message.moneyRequest) {
        return <MoneyRequestMessage message={message} chat={chat} />
    }
    const gotoReply = () => {
        if (!document) return
        const element = document.getElementById(`message-${message.parent?.uuid}`)
        if (element) {
            element.scrollIntoView({
                behavior: 'smooth',
                block: 'center',
            })
            // Add flash effect
            element.classList.add('flash-bg')

            // Remove class after 2 seconds to reset
            setTimeout(() => {
                element.classList.remove('flash-bg')
            }, 3500)
        }
    }
    return (
        <div key={"message-" + message.uuid} >
            {children}
            <div id={`message-${message.uuid}`} className={`rounded-lg overflow-hidden message ${message.by_me ? 'me' : ''}`}>

                {!message.by_me && (
                    <img
                        className={min('md') ? "avatar-md me-2" : "avatar-sm me-2"}
                        src={image(message.from?.avatar)}
                        onError={(e) => {
                            //@ts-ignore
                            e.target.src = defaultAvatar
                        }}
                        data-toggle="tooltip"
                        data-placement="top"
                        title={chat.from?.name}
                        alt="avatar"
                    />
                )}
                <div className={cn("flex flex-col max-sm:!max-w-[320px] w-max", message.by_me ? 'items-end' : 'items-start')}>
                    <div className={cn("group w-full", message.by_me ? 'text-white' : 'text-gray-800')}>
                        {message.parent && <ReplyToMessage onClick={() => gotoReply()} message={message.parent} className={cn(message.by_me ? "rounded-br-none me-1" : "rounded-bl-none ms-1", '-mb-1 cursor-pointer')} />}
                        <div className={cn("relative font-medium text w-full max-w-max !rounded-xl !py-2.5 !px-3 flex items-center justify-center flex-col", message.by_me ? "me !rounded-br-none" : "!rounded-bl-none")}>
                            {message.type === 'text' ? <TextMessage message={message} /> : <ImageMessage message={message} />}
                            <MessageContextMenu message={message} />
                        </div>
                        <div className={cn("!text-gray-400 !font-normal !text-xs mt-1", message.by_me ? 'text-end' : 'text-start')}>{format(parseISO(message.created_at as string), 'hh:mm a')}</div>
                    </div>
                </div>

            </div>
        </div>
    )
}
export default Message
