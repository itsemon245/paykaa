import useBreakpoint from "@/Hooks/useBrakpoints";
import { RouteName } from "@/types";
import { ChatData } from "@/types/_generated";
import { cn } from "@/utils";
import { usePage } from "@inertiajs/react";

export default function ChatLayout({ children }: { children: any }) {
    return (
        <BaseLayout>
            <Head title="Chats">
            </Head>
            <div className={cn("overflow-hidden lg:flex h-full")}>
                {children}
            </div>
        </BaseLayout>
    )
}
