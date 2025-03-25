import useBreakpoint from "@/Hooks/useBrakpoints";
import { useMessageStore } from "@/stores/useMessageStore";
import { ChatData, MessageData } from "@/types/_generated"
import { cn, defaultAvatar, image } from "@/utils";
import { usePage } from "@inertiajs/react";
import { format, parseISO } from "date-fns"

const Message = ({ message, children }: { message: MessageData, children?: React.ReactNode }) => {
    const pendingMoneyRequest = usePage().props.pendingMoneyRequest as MoneyRequestData | null
    const impoersonating = usePage().props.impersonating
    useEffect(() => {
        console.log("pendingMoneyRequest", pendingMoneyRequest)
    }, [pendingMoneyRequest])

    const chat = usePage().props.chat as ChatData;
    const { min } = useBreakpoint();
    const { user } = useAuth()
    const messageRef = useRef<HTMLDivElement>(null)
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
            <div id={`message-${message.uuid}`} className={cn("rounded-lg overflow-hidden message", message.by_me && 'me', message.type === 'money_request' && 'money-request')}>
                {!message.by_me && (
                    <img
                        className={cn(
                            min('md') ? "avatar-md me-2" : "avatar-sm me-2",
                            message.from?.id != 1 && impoersonating && pendingMoneyRequest ?
                                (pendingMoneyRequest.sender_id === message.from?.id ? "!border-2 !border-green-500" : "!border-2 !border-red-500") : ""
                        )
                        }
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
                {message.type === 'money_request' ? <MoneyRequestMessage message={message} chat={chat} />
                    :
                    <div className={cn("flex flex-col max-sm:!max-w-[320px] sm:!max-w-[400px] md:!max-w-[600px] w-max", message.by_me ? 'items-end' : 'items-start')}>
                        <div className={cn("group flex flex-col w-full", message.by_me ? 'text-white justify-end' : 'text-gray-800')}>
                            {message.parent && <ReplyToMessage onClick={() => gotoReply()} message={message.parent} className={cn(message.by_me ? "rounded-br-none me-1" : "rounded-bl-none ms-1", '-mb-1 cursor-pointer')} />}
                            <div className={cn("relative font-medium text w-full !max-w-max !rounded-xl flex items-center justify-center flex-col", message.by_me ? "!rounded-br-none ms-auto me" : "!rounded-bl-none", message.type === 'image' ? '!bg-white !p-2' : '!py-2.5 !px-3')}>
                                {message.type === 'text' ? <TextMessage message={message} /> : <ImageMessage message={message} />}
                                <MessageContextMenu message={message} />
                            </div>
                            <div className={cn("!text-gray-400 !font-normal !text-xs mt-1", message.by_me ? 'text-end' : 'text-start')}>{format(parseISO(message.created_at as string), 'hh:mm a')}</div>
                        </div>
                    </div>
                }

            </div>
        </div>
    )
}
export default Message
