import { cookie, getQuery, poll } from '@/utils';
import { usePage } from '@inertiajs/react';
import toast, { Toaster } from 'react-hot-toast';
export default function BaseLayout({ children }: { children?: any }) {
    const { error, success, impersonating } = usePage().props;
    const { updateActiveStatus } = useActiveStatus();
    const auth = useAuth();


    useEffect(() => {
        if (auth.user) {
            cookie.remove('referId');
            return poll(() => updateActiveStatus(), 19000);
        }
    }, [])
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
            {impersonating && impersonating.old && <a href={"/admin/login-as/" + impersonating?.old} className='z-[1000] fixed top-0 left-[50%] translate-x-[-50%] !bg-amber-500 cursor-pointer px-5 py-2 text-xl text-white rounded-b-md font-bold'>
                Back to Dashboard
            </a>
            }
            <main className="h-full">
                {children}
            </main>
            <Toaster position="top-center" />
            <ConfirmationDialog />
        </div>
    )
}
