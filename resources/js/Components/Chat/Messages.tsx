import { PaginatedCollection } from '@/types';
import { ChatData, MessageData } from '@/types/_generated';
import { usePage } from '@inertiajs/react';
import React, { RefObject } from 'react'
import Message from './Message';

export default function Messages({
    messages,
    messageContainerRef,
}: {
    messages: PaginatedCollection<MessageData> | undefined,
    messageContainerRef: RefObject<HTMLDivElement>
}) {
    const chat = usePage().props.chat as ChatData;
    const checkForNewMessages = () => {
        fetch(route('messages.new', { chat: chat.uuid }))
    }
    return (
        <div className='content' scroll-region="true" ref={messageContainerRef}>
            <div className="flex flex-col-reverse w-full px-2">
                {!messages?.data ? (
                    <div className="flex flex-col items-center justify-center w-full h-full gap-2">
                        <i className="ti-comments text-xl sm:text-3xl"></i>
                        <p className='text-xl font-bold text-center'>
                            Seems people are shy to start the chat. Break the ice
                            send the first message.
                        </p>
                    </div>
                ) : (messages.data?.map(message =>
                    <div key={"message-" + message.uuid}>
                        <div className="date">
                            <hr />
                            <span>Yesterday</span>
                            <hr />
                        </div>
                        <Message message={message} />
                    </div>
                ))}
            </div>
        </div>


    )
}
