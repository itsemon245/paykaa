import useBreakpoint from "@/Hooks/useBrakpoints";
import { ChatData } from "@/types/_generated";
import { cn } from "@/utils";
import { usePage } from "@inertiajs/react";

export default function ChatLayout({ children }: { children: any }) {
    const chat = usePage().props.chat as ChatData;
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
                <RequestMoneyChatList chat={chat} />
            </div>
            }
            <div className={cn("overflow-hidden lg:flex h-full")}>
                {(route().current('chat.index') || !isMobile) && <ChatSidebar />}
                <div className={`main h-full ${route().current('chat.show') ? '!right-0' : ''}`}>
                    {children}
                </div>
            </div>
        </BaseLayout>
    )
}
