import { cn } from "@/lib/utils"
import { MessageData } from "@/types/_generated"

export default function TextMessage({
    message,
}: { message: MessageData }) {
    const textMessageRef = useRef<HTMLDivElement>(null)
    return (
        <div className={cn((textMessageRef.current?.clientHeight ?? 0) < 45 ? "text-center" : 'text-start')} ref={textMessageRef}>{message.body}</div>
    )
}

