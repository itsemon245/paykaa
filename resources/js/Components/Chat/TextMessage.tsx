import { MessageData } from "@/types/_generated"

export default function TextMessage({
    message,
}: { message: MessageData }) {
    return (
        <div className="text-center">{message.body}</div>
    )
}

