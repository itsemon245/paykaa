import InputError from '@/Components/InputError';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import GuestLayout from '@/Layouts/GuestLayout';
import { Head, Link, useForm } from '@inertiajs/react';
import { Button } from 'primereact/button';
import { FormEventHandler } from 'react';

export default function ForgotPassword({ status }: { status?: string }) {
    const { data, setData, post, processing, errors } = useForm({
        email: '',
    });

    const container = useRef<HTMLDivElement>(null);
    const loginBtn = useRef<HTMLButtonElement>(null);
    useEffect(() => {
        loginBtn.current?.addEventListener('click', () => {
            container.current?.classList.remove('active');
        });
    }, [loginBtn, container]);

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route('password.email'));
    };

    return (
        <>
            <Head title="Forgot Password" />
            <main className='main-div'>
                <div className="auth-container" ref={container}>
                    <div className="p-5 flex flex-col items-center justify-center w-full h-full">
                        <h2 className="text-3xl font-bold text-center text-gray-600 !mb-6">Reset Password</h2>
                        <div className="mb-4 text-sm text-gray-600 dark:text-gray-400">
                            Forgot your password? No problem. Just let us know your email
                            address and we will email you a password reset link that will
                            allow you to choose a new one.
                        </div>

                        {status && (
                            <div className="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
                                {status}
                            </div>
                        )}

                        <form onSubmit={submit} className='form'>
                            <TextInput
                                id="email"
                                placeholder="Enter your email"
                                type="email"
                                name="email"
                                value={data.email}
                                className="mt-1 block w-full"
                                isFocused={true}
                                onChange={(e) => setData('email', e.target.value)}
                            />

                            <InputError message={errors.email} className="mt-2" />

                            <div className="!mt-5 flex items-center justify-end gap-5">
                                <Link href={route('login')} className="ms-4">
                                    <Button label='Cancel' outlined text className='border' />
                                </Link>
                                <PrimaryButton className="ms-4" disabled={processing}>
                                    {processing ? 'Sending email...' : 'Reset Password'}
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </>
    );
}
