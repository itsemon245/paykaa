import { PickerValue } from '@/Components/RequestMoney/TimeSelector'
import { MessageData } from '@/types/_generated'
import { create } from 'zustand'

interface MessageStore {
    replyTo?: MessageData
    duration: PickerValue
    setReplyTo: (replyTo?: MessageData) => void
    setDuration: (duration: PickerValue) => void
}
export const useMessageStore = create<MessageStore>((set, get) => ({
    replyTo: undefined,
    duration: {
        day: 0,
        hour: 6,
        minute: 0
    },
    setDuration: (duration: PickerValue) => set({ duration }),
    setReplyTo: (replyTo?: MessageData) => set({ replyTo }),
}))
