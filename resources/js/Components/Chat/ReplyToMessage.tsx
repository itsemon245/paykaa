import { MessageData } from '@/types/_generated'
import { cn } from '@/utils'
import React from 'react'

export default function ReplyToMessage({
    message,
    className,
    onClick,
}: { message: MessageData, className?: string, onClick?: () => void }) {
    if (message.type === 'image') {
        return <div className="overflow-hidden border-l-2 border-r-2 !border-primary-500 p-1 ms-1 bg-primary-100 rounded-lg w-max">
            <ImageMessage message={message} />
        </div>
    }
    return (
        <div onClick={e => onClick?.()} className={cn("text-gray-700 border-l-2 border-r-2 !border-primary-500 px-3 py-2 ms-1 bg-primary-100 rounded-lg w-max", className)}>{message.body}</div>
    )
}

