import { usePage } from '@inertiajs/react';
import toast, { Toaster } from 'react-hot-toast';
export default function BaseLayout({ children }: { children?: any }) {
    const main = useRef<HTMLDivElement>(null);
    const preloader = useRef<HTMLDivElement>(null);
    const { error, success } = usePage().props;
    useEffect(() => {
        if (main.current) {
            setTimeout(() => {
                preloader.current?.remove();
            }, 500);
        }
    }, [main.current])
    useEffect(() => {
        if (error) {
            toast.error(error)
        }
        if (success) {
            toast.success(success)
        }
    }, [error, success])
    return (
        <div className="min-h-screen w-full grid relative">
            {/*            <div ref={preloader} className="h-screen w-screen flex items-center justify-center z-50">
                <i className="pi pi-spinner pi-spin text-5xl text-primary" />
            </div>*/}
            <div className="absolute inset-0 bg-base-gradient -z-10"></div>
            <main ref={main} className="h-full">
                {children}
            </main>
            <Toaster position="top-center" />
        </div>
    )
}
