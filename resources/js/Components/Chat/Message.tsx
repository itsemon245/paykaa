import { ChatData, MessageData } from "@/types/_generated"
import { cn, defaultAvatar, image } from "@/utils";
import { usePage } from "@inertiajs/react";
import { format, parseISO } from "date-fns"
import { Image } from "primereact/image";

const Message = ({ message, children }: { message: MessageData, children?: React.ReactNode }) => {
    const chat = usePage().props.chat as ChatData;
    if (message.moneyRequest) {
        return <MoneyRequestMessage message={message} chat={chat} />
    }
    return (
        <div key={"message-" + message.uuid}>
            {children}
            <div className={`message ${message.by_me ? 'me' : ''}`}>
                {!message.by_me && (
                    <img
                        className="avatar-md"
                        src={chat.from?.avatar}
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
                <div className="text-main">
                    <div className={`text-group ${message.by_me ? 'me' : ''}`}>
                        {message.type === 'image' ?
                            <Image pt={{
                                image: {
                                    className: "rounded-lg w-28 md:w-52 max-h-[500px] h-auto object-contain",
                                },
                                preview: {
                                    className: "py-4"
                                }
                            }}
                                downloadable
                                src={image(message.body)}
                                alt="Image" preview />
                            : <div className={`text ${message.by_me ? 'me font-medium text-white' : ''}`}>
                                <div>{message.body}</div>
                            </div>
                        }
                    </div>
                    <div className={cn("!text-gray-400 !font-normal !text-xs", message.by_me ? 'text-end' : 'text-start')}>{format(parseISO(message.created_at as string), 'hh:mm a')}</div>
                </div>
            </div>
        </div>
    )
}
export default Message
