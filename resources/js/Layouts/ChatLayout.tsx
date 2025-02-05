import useBreakpoint from "@/Hooks/useBrakpoints";
import { cn } from "@/utils";

export default function ChatLayout({ children }: { children: any }) {
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
                <link rel="stylesheet" href="/assets/chat/css/bootstrap.min.css" />
                <link rel="stylesheet" href="/assets/chat/css/perfect-scrollbar.min.css" />
                <link rel="stylesheet" href="/assets/chat/css/themify-icons.css" />
                <link rel="stylesheet" href="/assets/chat/css/emoji.css" />
                <link rel="stylesheet" href="/assets/chat/css/style.css" />
                <link rel="stylesheet" href="/assets/chat/css/responsive.css" />

                <script src="/assets/chat/js/jquery3.3.1.js" defer></script>
                <script src="/assets/chat/js/vendor/jquery-slim.min.js" defer></script>
                <script src="/assets/chat/js/vendor/popper.min.js" defer></script>
                <script src="/assets/chat/js/bootstrap.min.js" defer></script>
                <script src="/assets/chat/js/perfect-scrollbar.min.js" defer></script>
                <script src="/assets/chat/js/script.js" defer></script>
            </Head>
            <div className={cn("overflow-hidden lg:flex h-full", loading && 'hidden')}>
                {(route().current('chat.index') || !isMobile) && <ChatSidebar />}
                <div ref={main} className={`z-[-1] main h-full ${route().current('chat.show') ? '!right-0' : ''}`}>
                    {children}
                </div>
            </div>
            <div ref={preloader} className="h-screen w-screen fixed inset-0 flex items-center justify-center z-50 bg-base-gradient overflow-hidden">
                <i className="pi pi-spinner pi-spin text-5xl text-primary" />
            </div>
        </BaseLayout>
    )
}
