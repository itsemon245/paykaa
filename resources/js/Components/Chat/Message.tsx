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
    const setContextMenu = useMessageStore(state => state.setContextMenu)
    if (message.moneyRequest) {
        return <MoneyRequestMessage message={message} chat={chat} />
    }
    return (
        <div key={"message-" + message.uuid}>
            {children}
            <div className={`message ${message.by_me ? 'me' : ''}`}>

                {!message.by_me && (
                    <img
                        className={min('md') ? "avatar-md me-2" : "avatar-sm me-2"}
                        src={image(chat.from?.avatar)}
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
                <div onContextMenu={setContextMenu(true)} className={cn("relative group w-max", message.by_me ? 'text-white' : 'text-gray-800')}>
                    <MessageContextMenu message={message} />
                    <div className={cn("font-medium text !rounded-xl !py-2.5 !px-3 w-full flex items-center justify-center flex-col", message.by_me ? "me !rounded-br-none" : "!rounded-bl-none")}>
                        {message.type === 'text' ? <TextMessage message={message} /> : <ImageMessage message={message} />}
                    </div>
                    <div className={cn("!text-gray-400 !font-normal !text-xs mt-1", message.by_me ? 'text-end' : 'text-start')}>{format(parseISO(message.created_at as string), 'hh:mm a')}</div>
                </div>

            </div>
        </div>
    )
}
export default Message
