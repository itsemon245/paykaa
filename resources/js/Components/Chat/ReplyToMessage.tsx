import { MessageData } from '@/types/_generated'
import { cn } from '@/utils'
import React from 'react'

export default function ReplyToMessage({
    message,
    className,
    onClick,
}: { message: MessageData, className?: string, onClick?: () => void }) {
    return (
        <div onClick={e => onClick?.()} className={cn("border-l-2 border-r-2 !border-primary px-3 py-2 ms-1 bg-primary-100 rounded-lg", className)}>{message.body}</div>
    )
}

