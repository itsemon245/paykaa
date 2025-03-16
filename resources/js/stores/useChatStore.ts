import { create } from 'zustand'

interface ChatStore {
    messageBody: string
    setMessageBody: (messageBody: string) => void
}
export const useChatStore = create<ChatStore>((set, get) => ({
    messageBody: '',
    setMessageBody: (messageBody: string) => set({ messageBody }),
}))
