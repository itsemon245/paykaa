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
    const { data, setData, processing, post } = useForm<Partial<MessageData> & { image: File | null }>({
        body: "",
        sender_id: user.id,
        receiver_id: chat.from?.id,
        chat_id: chat.id,
        type: "text",
        image: null,
    });
    const sendThrottledMessage = throttle(async () => {
        const messageStoreUrl = route('message.store', { chat: chat.uuid });
        const loadingToast = toast.loading("Sending message...");
        post(messageStoreUrl, {
            only: ['messages'],
            onSuccess(data) {
                if (data.props.error) {
                    toast.error(data.props.error, {
                        id: loadingToast
                    });
                    return;
                }
                toast.success("Message sent successfully", {
                    id: loadingToast
                });
                setData('body', "");
                setData('image', null);
            },
            onError(error) {
                console.error("Error while sending message", error);
                toast.error("Error while sending message", {
                    id: loadingToast
                });
            }
        });
    }, 1000, { leading: true, trailing: false });

    const uploadFile = (e: React.ChangeEvent<HTMLInputElement>) => {
        const file = e.target.files?.[0];
        if (!file) {
            return;
        }
        if (file.size > 1024 * 1024 * 5) {
            toast.error("File size should be less than 5MB");
            return;
        }
        setData('image', file);
    }

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
        if (!data.body && !data.image) {
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
    return (
        <>
            <div className="fixed bottom-0 left-2 lg:left-[372px] right-2">
                {data.image &&
                    <div className="p-2 relative w-max">
                        <button className="absolute -top-0 -right-0 text-white w-5 h-5 inline-flex items-center justify-center bg-red-500 rounded-full" onClick={() => setData('image', null)}>
                            <i className="pi pi-times"></i>
                        </button>
                        <img className="rounded-lg w-auto h-16 object-cover shadow-md" src={URL.createObjectURL(data.image as Blob)} alt="image" />
                    </div>
                }
                <div className="bottom !p-2 bg-base-gradient">
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
                    <div className='ms-2'>
                        <input type="file" accept='image/*' id="image-input" onChange={uploadFile} />
                        <label htmlFor="image-input" className='w-10 h-10 !flex items-center justify-center cursor-pointer !rounded-full bg-chat-gradient border-none' aria-label="Upload">
                            <i className="pi pi-paperclip text-white"></i>
                        </label>
                    </div>

                </div>
            </div>
        </>
    )
}
