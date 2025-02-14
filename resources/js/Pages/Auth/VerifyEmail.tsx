import PrimaryButton from '@/Components/PrimaryButton';
import useBreakpoint from '@/Hooks/useBrakpoints';
import GuestLayout from '@/Layouts/GuestLayout';
import { Head, Link, router, useForm } from '@inertiajs/react';
import { Button } from 'primereact/button';
import { FormEventHandler } from 'react';
import toast from 'react-hot-toast';

export default function VerifyEmail({ status }: { status?: string }) {
    const { post, processing } = useForm({});
    const { user } = useAuth();
    const { min, max } = useBreakpoint()

    const container = useRef<HTMLDivElement>(null);
    const registerBtn = useRef<HTMLButtonElement>(null);
    const loginBtn = useRef<HTMLButtonElement>(null);
    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        const toastId = toast.loading('Sending verification link...');
        post(route('verification.send'), {
            onSuccess: () => {
                toast.success('Verification link sent', { id: toastId });
            },
            onError: () => {
                toast.error('Failed to send verification link', { id: toastId });
            }
        });
    };

    useEffect(() => {
        registerBtn.current?.addEventListener('click', () => {
            container.current?.classList.add('active');
        });

        loginBtn.current?.addEventListener('click', () => {
            container.current?.classList.remove('active');
        });
    }, [loginBtn, registerBtn, container]);
    return (
        <GuestLayout>
            <Head title="Email Verification" />

            <main className='main-div'>
                <div className='auth-container' ref={container}>
                    <div className="p-5 flex flex-col items-center justify-center w-full h-full form-box">
                        <form onSubmit={submit} className='form'>
                            <div className="flex items-center justify-center mb-4">
                                <Logo className="!w-[140px]" />
                            </div>
                            <div className="flex flex-col justify-between w-full">
                                <div className="text-green-500 text-center flex justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"><mask id="lineMdEmailCheckTwotone0"><g fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path stroke-dasharray="64" stroke-dashoffset="64" d="M4 5h16c0.55 0 1 0.45 1 1v12c0 0.55 -0.45 1 -1 1h-16c-0.55 0 -1 -0.45 -1 -1v-12c0 -0.55 0.45 -1 1 -1Z"><animate fill="freeze" attributeName="stroke-dashoffset" dur="0.6s" values="64;0" /></path><path stroke-dasharray="24" stroke-dashoffset="24" d="M3 6.5l9 5.5l9 -5.5"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.6s" dur="0.2s" values="24;0" /></path><path fill="#fff" fill-opacity="0" stroke="none" d="M12 11l-8 -5h16l-8 5Z"><animate fill="freeze" attributeName="fill-opacity" begin="1s" dur="0.15s" values="0;0.3" /></path><path fill="#000" fill-opacity="0" stroke="none" d="M19 13c3.31 0 6 2.69 6 6c0 3.31 -2.69 6 -6 6c-3.31 0 -6 -2.69 -6 -6c0 -3.31 2.69 -6 6 -6Z"><set fill="freeze" attributeName="fill-opacity" begin="0.8s" to="1" /></path><path stroke-dasharray="10" stroke-dashoffset="10" d="M16 19l1.75 1.75l3.75 -3.75"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.8s" dur="0.2s" values="10;0" /></path></g></mask><rect width="24" height="24" fill="currentColor" mask="url(#lineMdEmailCheckTwotone0)" /></svg>
                                </div>

                                <h3 className='text-lg font-bold'>Verification link sent</h3>
                                <p>Please check your inbox or spam folder</p>
                                <div className="mt-4 flex items-center gap-2 justify-end">
                                    {user && <Link href={route('logout')} method="post" as="button">
                                        <Button
                                            link>
                                            Log Out
                                        </Button>
                                    </Link>
                                    }
                                    <PrimaryButton disabled={processing}>
                                        {processing ? 'Sending...' : 'Resend'}
                                    </PrimaryButton>
                                </div>
                            </div>
                        </form>
                    </div>
                    {
                        min('md') && <div className="toggle-box">
                            <div className="toggle-panel toggle-left">
                                <h1>Verify Email</h1>
                                <p>Don't have an account?</p>
                                <button onClick={() => {
                                    container.current?.classList.add('active');
                                    setTimeout(() => {
                                        router.visit(route('login', { register: true }))
                                    }, 1000);
                                }} className="p-button bg-transparent rounded-lg text-white border-white border-2 px-3" >
                                    Register
                                </button>
                            </div>
                            <div className="toggle-panel toggle-right">
                                <h1>Hello, Welcome!</h1>
                                <p>Already have an account?</p>
                                <button className="p-button bg-transparent rounded-lg text-white border-white border-2 px-3" ref={loginBtn}>
                                    Login
                                </button>
                            </div>
                        </div>
                    }

                </div >
            </main >
        </GuestLayout >
    );
}
