import { usePage } from '@inertiajs/react';
import toast, { Toaster } from 'react-hot-toast';
export default function BaseLayout({ children }: { children?: any }) {
    const { error, success } = usePage().props;
    useEffect(() => {
        if (error) {
            toast.error(error)
        }
        if (success) {
            toast.success(success)
        }
    }, [error, success])
    return (
        <div className="min-h-screen w-full grid relative overflow-y-hidden overflow-x-hidden">
            <div className="absolute inset-0 bg-base-gradient -z-10"></div>
            <main className="h-full">
                {children}
            </main>
            <Toaster position="top-center" />
        </div>
    )
}
