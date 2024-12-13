import { MessageData } from "@/types/_generated"
import { format, parseISO } from "date-fns"

const Message = ({ message }: { message: MessageData }) => {
    return (
        <>
            <div className={`message ${message.by_me ? 'me' : ''}`}>
                {!message.by_me && (
                    <img
                        className="avatar-md"
                        src="/assets/chat/img/avatars/avatar-female-5.jpg"
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Karen joye"
                        alt="avatar"
                    />
                )}
                <div className="text-main">
                    <div className={`text-group ${message.by_me ? 'me' : ''}`}>
                        <div className={`text ${message.by_me ? 'me' : ''}`}>
                            <div>{message.body}</div>
                        </div>
                    </div>
                    <span>{format(parseISO(message.created_at), 'hh:mm a')}</span>
                </div>
            </div>
            {/*
            <div className="message me">
                <div className="text-main">
                    <div className="text-group me">
                        <div className="text me">
                            <p>
                                But if you are not available to talk, then
                                would't they miss you more?
                            </p>
                        </div>
                    </div>
                    <span>11:32 AM</span>
                </div>
            </div>

            */}

        </>
    )
}
export default Message
