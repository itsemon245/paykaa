import { PaginatedCollection } from '@/types';
import { ChatData, MessageData } from '@/types/_generated';
import { usePage } from '@inertiajs/react';
import React from 'react'
import Message from './Message';

export default function Messages({
    messages,
}: {
    messages: PaginatedCollection<MessageData> | undefined
}) {
    useEffect(() => {
        console.log(messages === undefined);
    }, [messages]);
    return (
        <div className="content" id="content">
            <div className="col-md-12 mt-0 h-full">
                {!messages?.data ? (
                    <div className="flex flex-col items-center justify-center w-full h-full gap-2">
                        <i className="ti-comments text-xl sm:text-3xl"></i>
                        <p className='text-xl font-bold text-center'>
                            Seems people are shy to start the chat. Break the ice
                            send the first message.
                        </p>
                    </div>
                ) : (messages.data?.map(message =>
                    <>
                        <div className="date">
                            <hr />
                            <span>Yesterday</span>
                            <hr />
                        </div>
                        <Message message={message} />
                    </>
                ))}
            </div>

        </div>
    )
}
