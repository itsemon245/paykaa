import { cn } from "@/utils";

export default function SidebarCloseBtn({
    className,
    isSidebarOpen,
    toggleSidebar
}: {
    className?: string,
    isSidebarOpen: boolean,
    toggleSidebar: () => void
}) {
    return <button className={cn("text-white rounded w-7 h-7", className)} onClick={toggleSidebar}>
        <div className={cn("transition-all duration-500 w-full h-full", isSidebarOpen ? 'rotate-180' : '')}>{isSidebarOpen ? <HugeiconsCancel01 className="w-full h-full" /> : <HugeiconsMenu02 className="w-full h-full" />}</div>
    </button>
}
