import { cn } from "@/lib/utils"
import { MessageData } from "@/types/_generated"
import linkifyHtml from 'linkify-html';

export default function TextMessage({
    message,
}: { message: MessageData }) {
    const body = linkifyHtml(message.body ?? '', {
        target: '_blank',
        rel: 'noopener noreferrer',
        className: cn('!font-bold !underline', message.by_me ? '!text-gray-800 hover:!text-gray-300' : '!text-primary-500 hover:!text-primary-600'),
        attributes: {
            target: '_blank',
            rel: 'noopener noreferrer',
        }
    })
    return (
        <div className="whitespace-pre-line" dangerouslySetInnerHTML={{ __html: body }} />
    )
}

