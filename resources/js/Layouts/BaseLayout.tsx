import { Toaster } from 'react-hot-toast';
export default function BaseLayout({ children }: { children?: any }) {
    const main = useRef<HTMLDivElement>(null);
    const preloader = useRef<HTMLDivElement>(null);
    useEffect(() => {
        if (main.current) {
            setTimeout(() => {
                preloader.current?.remove();
            }, 500);
        }
    }, [main.current])
    return (
        <div className="min-h-screen w-full grid relative">
            <div ref={preloader} className="h-screen w-screen flex items-center justify-center z-50">
                <i className="pi pi-spinner pi-spin text-5xl text-primary" />
            </div>
            <div className="absolute inset-0 bg-base-gradient -z-10"></div>
            <main ref={main} className="">
                {children}
            </main>
            <Toaster position="top-center" />
        </div>
    )
}
