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
    useEffect(() => {
        console.log("messages re-render");
    }, [messages]);
    return (
        <div className='content' scroll-region="true" ref={messageContainerRef}>
            <div ref={messageContainerRef} className="col-md-12 mt-0 h-full">
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
