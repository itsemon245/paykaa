import { debounce, throttle } from 'lodash';
import toast, { Toaster } from 'react-hot-toast';
import { PaginatedCollection } from "@/types";
import { ChatData, MessageData, MessageType } from "@/types/_generated";
import { useForm, usePage } from "@inertiajs/react";
import { InputTextarea } from 'primereact/inputtextarea';

export default function Show() {
    const messagesProp = usePage().props.messages as PaginatedCollection<MessageData>;
    const [messages, setMessages] = useState<PaginatedCollection<MessageData>>(messagesProp);
    return (
        <div className="chat" id="chat1" >
            <Topbar />
            <Messages messages={messages} setMessages={setMessages} />
            <Writer setMessages={setMessages} />
        </div>

    )
}

