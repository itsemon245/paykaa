import { useMessageStore } from '@/stores/useMessageStore'
import { MessageData } from '@/types/_generated'
import { cn } from '@/utils'
import { ContextMenu } from 'primereact/contextmenu'
import toast from 'react-hot-toast'

export default function MessageContextMenu({
    message,
}: { message: MessageData }) {
    const cm = useRef<ContextMenu>(null)
    const reply = useMessageStore(state => state.reply)
    const setContextMenu = useMessageStore(state => state.setContextMenu)
    const setReplyTo = useMessageStore(state => state.setReplyTo)
    const items = [
        {
            label: "Reply",
            icon: "pi pi-comment",
            command: () => {
                toast.success("Reply")
            }
        }
    ]
    return (
        <div className={cn("absolute top-0 opacity-0 group-hover:opacity-100 transition-opacity", message.by_me ? 'left-0' : 'right-0')}>
            <HeroiconsChevronDown20Solid className="h-6 w-6 cursor-pointer" onClick={() => setContextMenu(true)} />
            <ContextMenu model={items} ref={cm} breakpoint="767px" />
        </div>

    )
}

