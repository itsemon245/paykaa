import { create } from 'zustand'

type Variant = 'destructive' | 'warning' | 'success' | 'info'
interface ConfirmStore {
    open: boolean
    variant: Variant
    description?: string
    onAction: (action: (...args: any[]) => any) => void
    onCancel: () => void
    onConfirm: () => void
    setDescription: (description: string) => void
    setVariant: (variant: Variant) => void
    setOpen: (open: boolean) => void
    setOnConfirm: (onConfirm: () => void) => void
    setOnCancel: (onCancel: () => void) => void
}
export const useConfirmStore = create<ConfirmStore>((set, get) => ({
    open: false,
    variant: 'destructive',
    description: 'This action cannot be undone an is permanent.',
    onAction: (action: (...args: any[]) => any) => {
        get().setOpen(true)
        get().setOnConfirm(action)
    },
    onConfirm: () => { },
    onCancel: () => { },
    setDescription: (description: string) => set({ description }),
    setVariant: (variant: Variant) => set({ variant }),
    setOpen: (open: boolean) => set({ open }),
    setOnConfirm: (onConfirm: () => void) => set({ onConfirm }),
    setOnCancel: (onCancel: () => void) => set({ onCancel }),
}))
