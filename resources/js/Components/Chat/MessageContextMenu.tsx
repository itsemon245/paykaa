import { useMessageStore } from '@/stores/useMessageStore'
import { MessageData } from '@/types/_generated'
import { cn } from '@/utils'
import toast from 'react-hot-toast'

export default function MessageContextMenu({
    message,
}: { message: MessageData }) {
    const setReplyTo = useMessageStore(state => state.setReplyTo)
    return (
        <div className={cn("absolute top-0 opacity-0 group-hover:opacity-100 transition-opacity", message.by_me ? 'left-0' : 'right-0')}>
            <HeroiconsChevronDown20Solid className="h-6 w-6 cursor-pointer" onClick={() => setReplyTo(message)} />
        </div>

    )
}
