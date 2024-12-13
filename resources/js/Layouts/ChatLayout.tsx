import { router } from "@inertiajs/react";

export default function ChatLayout({ children }: { children: any }) {
    const [isMobile, setIsMobile] = useState(false);
    useEffect(() => {
        setIsMobile(window.innerWidth < 768);
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
            <div className="overflow-hidden lg:flex h-full">
                {(route().current('chat.index') || !isMobile) && <Sidebar />}
                <div className={`main h-full ${route().current('chat.show') ? '!right-0' : ''}`}>
                    {children}
                </div>
            </div>
        </BaseLayout>
    )
}
