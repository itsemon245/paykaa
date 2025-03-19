import { create } from 'zustand'

interface ChatStore {
    messageBody: string
    setMessageBody: (messageBody: string) => void
    shouldResetMessageBody: boolean
    setShouldResetMessageBody: (shouldResetMessageBody: boolean) => void
}
export const useChatStore = create<ChatStore>((set, get) => ({
    messageBody: '',
    shouldResetMessageBody: false,
    setShouldResetMessageBody: (shouldResetMessageBody: boolean) => set({ shouldResetMessageBody }),
    setMessageBody: (messageBody: string) => set({ messageBody }),
}))
