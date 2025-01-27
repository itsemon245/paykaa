import { ChatData, MessageData } from "@/types/_generated"
import { usePage } from "@inertiajs/react";
import { format, parseISO } from "date-fns"

const Message = ({ message, children }: { message: MessageData, children?: React.ReactNode }) => {
    const chat = usePage().props.chat as ChatData;
    if (message.moneyRequest) {
        return <MoneyRequestMessage message={message} />
    }
    return (
        <div key={"message-" + message.uuid}>
            {children}
            <div className={`message ${message.by_me ? 'me' : ''}`}>
                {!message.by_me && (
                    <img
                        className="avatar-md"
                        src={chat.from?.avatar}
                        data-toggle="tooltip"
                        data-placement="top"
                        title={chat.from?.name}
                        alt="avatar"
                    />
                )}
                <div className="text-main">
                    <div className={`text-group ${message.by_me ? 'me' : ''}`}>
                        <div className={`text ${message.by_me ? 'me font-medium text-white' : ''}`}>
                            <div>{message.body}</div>
                        </div>
                    </div>
                    <span>{format(parseISO(message.created_at as string), 'hh:mm a')}</span>
                </div>
            </div>
        </div>
    )
}
export default Message
