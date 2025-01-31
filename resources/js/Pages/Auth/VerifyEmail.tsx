import PrimaryButton from '@/Components/PrimaryButton';
import useBreakpoint from '@/Hooks/useBrakpoints';
import GuestLayout from '@/Layouts/GuestLayout';
import { Head, Link, router, useForm } from '@inertiajs/react';
import { FormEventHandler } from 'react';

export default function VerifyEmail({ status }: { status?: string }) {
    const { post, processing } = useForm({});
    const { min, max } = useBreakpoint()

    const container = useRef<HTMLDivElement>(null);
    const registerBtn = useRef<HTMLButtonElement>(null);
    const loginBtn = useRef<HTMLButtonElement>(null);
    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route('verification.send'));
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
                            <div className="mt-4 flex items-center justify-between">
                                <PrimaryButton disabled={processing}>
                                    Resend Verification Email
                                </PrimaryButton>

                                <Link
                                    href={route('logout')}
                                    method="post"
                                    as="button"
                                    className="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                                >
                                    Log Out
                                </Link>
                            </div>
                        </form>
                    </div>
                    {min('md') && <div className="toggle-box">
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

                </div>
            </main>
        </GuestLayout>
    );
}
