import { cn } from "@/lib/utils"
import { MessageData } from "@/types/_generated"

export default function TextMessage({
    message,
}: { message: MessageData }) {
    return (
        <div className={cn("whitespace-pre-line")}>{message.body}</div>
    )
}

