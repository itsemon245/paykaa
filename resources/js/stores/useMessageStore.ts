import { MessageData } from '@/types/_generated'
import { create } from 'zustand'

interface MessageStore {
    replyTo?: MessageData
    setReplyTo: (replyTo?: MessageData) => void
}
export const useMessageStore = create<MessageStore>((set, get) => ({
    replyTo: undefined,
    setReplyTo: (replyTo?: MessageData) => set({ replyTo }),
}))
