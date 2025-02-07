import useBreakpoint from "@/Hooks/useBrakpoints";
import { ChatData } from "@/types/_generated";
import { cn } from "@/utils";
import { usePage } from "@inertiajs/react";

export default function ChatLayout({ children }: { children: any }) {
    const chat = usePage().props.chat as ChatData;
    const main = useRef<HTMLDivElement>(null);
    const [loading, setLoading] = useState(true);
    const preloader = useRef<HTMLDivElement>(null);
    useEffect(() => {
        if (main.current) {
            setTimeout(() => {
                preloader.current?.remove();
                setLoading(false);
            }, 500);
        }
    }, [main.current])

    const [isMobile, setIsMobile] = useState(false);
    const { max } = useBreakpoint();
    useEffect(() => {
        setIsMobile(max('md'));
    }, [window.innerWidth]);
    return (
        <BaseLayout>
            <Head title="Chats">
            </Head>
            {chat && <div className="fixed h-[76px] top-0 right-4 inline-flex items-center gap-2 !z-10">
                <RequestMoney chat={chat} />
                <RequestMoneyChatList chat={chat} />
            </div>
            }
            <div className={cn("overflow-hidden lg:flex h-full", loading && 'hidden')}>
                {(route().current('chat.index') || !isMobile) && <ChatSidebar />}
                <div ref={main} className={`main h-full ${route().current('chat.show') ? '!right-0' : ''}`}>
                    {children}
                </div>
            </div>
            <div ref={preloader} className="h-screen w-screen fixed inset-0 flex items-center justify-center z-50 bg-base-gradient overflow-hidden">
                <i className="pi pi-spinner pi-spin text-5xl text-primary" />
            </div>
        </BaseLayout>
    )
}
