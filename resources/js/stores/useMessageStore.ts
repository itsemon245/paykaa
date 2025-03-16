import toast from 'react-hot-toast'
import { create } from 'zustand'

interface MessageStore {
    contextMenu: boolean
    replyTo?: number
    setContextMenu: (contextMenu: boolean) => void
}
export const useMessageStore = create<MessageStore>((set, get) => ({
    contextMenu: false,
    replyTo: undefined,
    setReplyTo: (replyTo: number) => set({ replyTo }),
    setContextMenu: (contextMenu: boolean) => set({ contextMenu }),
    reply: (message: string) => {
        //send message
        toast.success("Reply")
    },
}))
