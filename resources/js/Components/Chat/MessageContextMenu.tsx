import { useMessageStore } from '@/stores/useMessageStore'
import { MessageData } from '@/types/_generated'
import { cn } from '@/utils'
import toast from 'react-hot-toast'

export default function MessageContextMenu({
    message,
}: { message: MessageData }) {
    const setReplyTo = useMessageStore(state => state.setReplyTo)
    return (
        <div className={cn("absolute top-0 md:opacity-0 group-hover:opacity-100 transition-opacity right-0")}>
            <MdiReply className="h-5 w-5 cursor-pointer" onClick={() => setReplyTo(message)} />
        </div>

    )
}


