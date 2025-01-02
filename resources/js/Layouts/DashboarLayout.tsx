import Sidebar from "@/Components/Sidebar";
import useBreakpoint from "@/Hooks/useBrakpoints";
import { cn } from "@/utils";
import { motion } from "motion/react"
export default function DashboardLayout({ children, animate }: { children?: JSX.Element | JSX.Element[], animate?: boolean }) {
    const { min, max, between } = useBreakpoint();
    const [isSidebarOpen, setIsSidebarOpen] = useState(false);
    const toggleSidebar = () => {
        setIsSidebarOpen(!isSidebarOpen);
    }
    useEffect(() => {
        setIsSidebarOpen(min('md'));
    }, [])
    return (
        <BaseLayout>
            <SquareBg animate={animate} />
            <div className="flex gap-4 relative justify-center z-10 h-screen px-2 w-screen overflow-x-hidden">
                {isSidebarOpen && <Sidebar className={cn("sticky", max('sm') ? '!w-[300px] flex-1 grow' : '')} isSidebarOpen={isSidebarOpen} toggleSidebar={toggleSidebar} />}
                <div className={cn("grow mt-5 max-w-5xl sm:px-3 overflow-y-scroll hide-scrollbar transition duration-500", max('sm') && isSidebarOpen ? 'translate-x-[1000px]' : '')}>
                    <Navbar toggleSidebar={toggleSidebar} isSidebarOpen={isSidebarOpen} className="mb-6" />
                    {children}
                </div>
            </div>
            <div className="z-[-1] fixed blur-lg -bottom-5 left-0 w-full h-[18vh] bg-gradient-to-t from-primary-200 to-transparent"></div>
        </BaseLayout>
    );
}
