import { debounce, throttle } from 'lodash';
import toast, { Toaster } from 'react-hot-toast';
import { PaginatedCollection } from "@/types";
import { ChatData, MessageData, MessageType } from "@/types/_generated";
import { useForm, usePage } from "@inertiajs/react";
import { InputTextarea } from 'primereact/inputtextarea';
import { Button } from 'primereact/button';
import { cn } from '@/utils';

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
            preserveState: false,
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
            <div className="fixed bottom-0 md:left-2 lg:left-[372px] left-0 right-0 md:right-2">
                {data.image &&
                    <div className="p-2 relative w-max">
                        <button className="absolute -top-0 -right-0 text-white w-5 h-5 inline-flex items-center justify-center bg-red-500 rounded-full" onClick={() => setData('image', null)}>
                            <i className="pi pi-times"></i>
                        </button>
                        <img className="rounded-lg max-h-[200px] w-auto object-cover shadow-md" src={URL.createObjectURL(data.image as Blob)} alt="image" />
                    </div>
                }
                <div className="bottom !p-1 md:!p-2 bg-base-gradient">
                    <form onSubmit={sendMessage} className="text-area relative">
                        <InputTextarea
                            className="form-control !ps-5 !rounded-full"
                            cols={3}
                            placeholder="Message ..."
                            value={data.body as string}
                            autoResize
                            ref={textAreaRef}
                            onKeyDown={handleKeyDown}
                            onChange={e => setData('body', e.target.value)}
                            rows={1}
                        ></InputTextarea>
                        <div className="flex h-full items-center gap-2 absolute top-0 right-0 !pe-3">
                            <div className='ms-2'>
                                <input type="file" accept='image/*' id="image-input" onChange={uploadFile} />
                                <label htmlFor="image-input" className='w-8 h-8 md:w-10 md:h-10 !flex items-center justify-center cursor-pointer !rounded-full border-none' aria-label="Upload">
                                    <i className="pi pi-paperclip text-gray-600"></i>
                                </label>
                            </div>
                            <button className={cn('ms-2 disabled:cursor-not-allowed w-8 h-8 md:w-10 md:h-10 !flex items-center p-2 justify-center cursor-pointer !rounded-full border-none', !data.body && !data.image ? 'bg-gray-400' : 'bg-chat-gradient')} type='submit' disabled={!data.body && !data.image}>
                                {processing
                                    ? <i className="pi pi-spinner pi-spin"></i>
                                    : <HugeiconsArrowUp02 className="text-white" />
                                }
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </>
    )
}
