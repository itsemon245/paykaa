import { debounce, throttle } from 'lodash';
import toast, { Toaster } from 'react-hot-toast';
import { PaginatedCollection } from "@/types";
import { ChatData, MessageData, MessageType } from "@/types/_generated";
import { useForm, usePage } from "@inertiajs/react";
import { InputTextarea } from 'primereact/inputtextarea';
import { Button } from 'primereact/button';

export default function Writer() {
    const chat = usePage().props.chat as ChatData;
    const { toggleTyping } = useTyping(chat);
    const textAreaRef = useRef<HTMLTextAreaElement>(null);
    const { user } = useAuth();
    const { data, setData, processing, post } = useForm<Partial<MessageData>>({
        body: "",
        sender_id: user.id,
        receiver_id: chat.from?.id,
        chat_id: chat.id,
        type: "text"
    });
    const sendThrottledMessage = throttle(async () => {
        const messageStoreUrl = route('message.store', { chat: chat.uuid });
        const loadingToast = toast.loading("Sending message...");
        post(messageStoreUrl, {
            only: ['messages'],
            onSuccess(data) {
                toast.dismiss(loadingToast);
                toast.success("Message sent successfully");
                setData('body', "");
            },
            onError(error) {
                console.error("Error while sending message", error);
            }
        });
    }, 1000, { leading: true, trailing: false });

    const handleKeyDown = (e: React.KeyboardEvent<HTMLTextAreaElement>) => {
        if (e.key !== 'Enter') {
            return;
        }
        if (e.shiftKey === false) {
            e.preventDefault();
            sendThrottledMessage();
            toggleTyping(false);
        } else {
            setData('body', data.body + "\n");
        }
    };
    const sendMessage = (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault();
        if (!data.body) {
            toast.error('Please enter a message')
            return;
        }
        sendThrottledMessage();
        toggleTyping(false);
    };
    useEffect(() => {
        if (!data.body) {
            toggleTyping(false);
        } else {
            toggleTyping(true);
        }
    }, [data.body]);
    return (<div className="col-md-12">
        <div className="bottom">
            <form onSubmit={sendMessage} className="text-area">
                <InputTextarea
                    className="form-control"
                    cols={3}
                    placeholder="Start typing for reply..."
                    value={data.body}
                    autoResize
                    ref={textAreaRef}
                    onKeyDown={handleKeyDown}
                    onChange={e => setData('body', e.target.value)}
                    rows={1}
                ></InputTextarea>
                <div className="add-smiles">
                    <span title="add icon" className="em em-blush"></span>
                </div>
                <div className="smiles-bunch">
                    <i className="em em---1"></i>
                    <i className="em em-smiley"></i>
                    <i className="em em-anguished"></i>
                    <i className="em em-laughing"></i>
                    <i className="em em-angry"></i>
                    <i className="em em-astonished"></i>
                    <i className="em em-blush"></i>
                    <i className="em em-disappointed"></i>
                    <i className="em em-worried"></i>
                    <i className="em em-kissing_heart"></i>
                    <i className="em em-rage"></i>
                    <i className="em em-stuck_out_tongue"></i>
                    <i className="em em-expressionless"></i>
                    <i className="em em-bikini"></i>
                    <i className="em em-christmas_tree"></i>
                    <i className="em em-facepunch"></i>
                    <i className="em em-pushpin"></i>
                    <i className="em em-tada"></i>
                    <i className="em em-us"></i>
                    <i className="em em-rose"></i>
                </div>
                <button type="submit" className="btn send p-2 sm:p-3">
                    {processing
                        ? <i className="pi pi-spinner pi-spin"></i>
                        : <i className="ti-location-arrow"></i>
                    }
                </button>
            </form>
            <label className='ms-2'>
                <input type="file" />
                <Button className='!rounded-full bg-chat-gradient border-none' icon="pi pi-paperclip" aria-label="Upload" rounded />
            </label>
        </div>
    </div>
    )
}
