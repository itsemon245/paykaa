import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { PasswordInput } from '@/Pages/Auth/Login';
import { Transition } from '@headlessui/react';
import { useForm } from '@inertiajs/react';
import { Password } from 'primereact/password';
import { FormEventHandler, useRef } from 'react';
import toast from 'react-hot-toast';

export default function UpdatePasswordForm({
    className = '',
}: {
    className?: string;
}) {
    const passwordInput = useRef(null);
    const currentPasswordInput = useRef(null);

    const {
        data,
        setData,
        errors,
        put,
        reset,
        processing,
        recentlySuccessful,
    } = useForm({
        current_password: '',
        password: '',
        password_confirmation: '',
    });

    const updatePassword: FormEventHandler = (e) => {
        e.preventDefault();

        put(route('password.update'), {
            preserveScroll: true,
            onSuccess: () => {
                toast.success('Password Updated');
                reset();
            },
            onError: (errors) => {
                if (errors.password) {
                    reset('password', 'password_confirmation');
                }

                if (errors.current_password) {
                    reset('current_password');
                }
            },
        });
    };

    return (
        <section className={className}>
            <form onSubmit={updatePassword} className="!mt-6 space-y-6">
                <div>
                    <InputLabel
                        className='text-gray-700'
                        htmlFor="current_password"
                        value="Current Password"
                    />

                    <Password
                        id="current_password"
                        value={data.current_password}
                        feedback={false}
                        ref={currentPasswordInput}
                        toggleMask
                        onChange={(e) =>
                            setData('current_password', e.target.value)
                        }
                        type="password"
                        className="mt-1 block w-full"
                        autoComplete="current-password"
                    />

                    <InputError
                        message={errors.current_password}
                        className="mt-2"
                    />
                </div>

                <div>
                    <InputLabel className='text-gray-700' htmlFor="password" value="New Password" />

                    <Password
                        id="password"
                        feedback={false}
                        toggleMask
                        ref={passwordInput}
                        value={data.password}
                        onChange={(e) => setData('password', e.target.value)}
                        type="password"
                        className="mt-1 block w-full"
                        autoComplete="new-password"
                    />

                    <InputError message={errors.password} className="mt-2" />
                </div>

                <div>
                    <InputLabel
                        htmlFor="password_confirmation"
                        className="text-gray-700"
                        value="Confirm Password"
                    />

                    <Password
                        id="password_confirmation"
                        feedback={false}
                        toggleMask
                        value={data.password_confirmation}
                        onChange={(e) =>
                            setData('password_confirmation', e.target.value)
                        }
                        type="password"
                        className="mt-1 block w-full"
                        autoComplete="new-password"
                    />

                    <InputError
                        message={errors.password_confirmation}
                        className="mt-2"
                    />
                </div>

                <div className="flex items-center gap-4">
                    <PrimaryButton disabled={processing} loading={processing}>{processing ? 'Updating...' : 'Update Password'}</PrimaryButton>

                    <Transition
                        show={recentlySuccessful}
                        enter="transition ease-in-out"
                        enterFrom="opacity-0"
                        leave="transition ease-in-out"
                        leaveTo="opacity-0"
                    >
                        <p className="text-sm text-gray-600 dark:text-gray-400">
                            Password Updated.
                        </p>
                    </Transition>
                </div>
            </form>
        </section>
    );
}
