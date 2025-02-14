import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import GuestLayout from '@/Layouts/GuestLayout';
import { Head, Link, router, useForm } from '@inertiajs/react';
import { FormEventHandler } from 'react';
import { PasswordInput } from './Login';
import useBreakpoint from '@/Hooks/useBrakpoints';

export default function ResetPassword({
    token,
    email,
}: {
    token: string;
    email: string;
}) {
    const { min, max } = useBreakpoint()
    const { data, setData, post, processing, errors, reset } = useForm({
        token: token,
        email: email,
        password: '',
        password_confirmation: '',
    });
    const container = useRef<HTMLDivElement>(null);
    const registerBtn = useRef<HTMLButtonElement>(null);
    const loginBtn = useRef<HTMLButtonElement>(null);


    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route('password.store'), {
            onFinish: () => reset('password', 'password_confirmation'),
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
            <Head title="Reset Password">
                <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
            </Head>

            <main className='main-div'>
                <div className='auth-container' ref={container}>
                    <div className="p-5 flex flex-col items-center justify-center w-full h-full form-box">
                        <form onSubmit={submit} className='form'>
                            <div className="flex items-center justify-center mb-4">
                                <Logo className="!w-[140px]" />
                            </div>
                            <h1>Reset Password</h1>
                            <div className="input-box opacity-65 cursor-not-allowed">
                                <input type="email" value={data.email} disabled placeholder="Email" required onChange={(e) => setData('email', e.target.value)} />
                                <i className='bx bxs-envelope'></i>
                            </div>
                            {errors.email && <InputError message={errors.email} className="mt-2" />}
                            <PasswordInput placeholder="New Password" required onChange={(e) => setData('password', e.target.value)} />
                            {errors.password && <InputError message={errors.password} className="mt-2" />}
                            <PasswordInput placeholder="Confirm New Password" required onChange={e => setData('password_confirmation', e.target.value)} />
                            {errors.password_confirmation && <InputError message={errors.password_confirmation} className="mt-2" />}
                            <button disabled={processing} type="submit" className="auth-btn">
                                {processing ? 'Resetting...' : 'Reset Password'}
                            </button>
                        </form>
                    </div>
                    {min('md') && <div className="toggle-box">
                        <div className="toggle-panel toggle-left">
                            <h1>Reset Password</h1>
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
