import InputError from '@/Components/InputError';
import { Password } from "primereact/password";
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import GuestLayout from '@/Layouts/GuestLayout';
import { Head, Link, useForm } from '@inertiajs/react';
import { Card } from 'primereact/card';
import { FormEventHandler } from 'react';
import { Button } from 'primereact/button';

export default function Register() {
    const { data, setData, hasErrors, post, processing, errors, setError, clearErrors, reset } = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    useEffect(() => {
        console.log(data.password, data.password_confirmation)
        if (data.password !== '' || data.password_confirmation !== '') {
            if (data.password !== data.password_confirmation) {
                setError('password', 'Passwords must match');
                setError('password_confirmation', 'Passwords must match');
            } else {
                clearErrors('password', 'password_confirmation');
            }
        } else {
            clearErrors('password', 'password_confirmation');
        }
    }, [data.password_confirmation, data.password])

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        clearErrors();
        if (data.name === '') {
            setError('name', 'Name is required!')
        }
        if (data.email === '') {
            setError('email', 'Email is required!');
        } else if (!data.email.includes('@')) {
            setError('email', 'Email is invalid!');
        }

        if (data.password === '') {
            setError('password', 'Password is required!')
        }
        if (data.password_confirmation === '') {
            setError('password_confirmation', 'Password confirmation is required!')
        }

        if (data.password !== data.password_confirmation) {
            setError('password', 'Passwords must match');
            setError('password_confirmation', 'Passwords must match');
        }

        if (hasErrors) {
            return;
        }
        post(route('register'), {
            onFinish: () => reset('password', 'password_confirmation'),
        });
    };

    return (
        <GuestLayout>
            <Head title="Register" />

            <Card className="min-w-[90vw] sm:min-w-[465px]">
                <form onSubmit={submit}>
                    <Input
                        id="name"
                        name="name"
                        label="Name"
                        value={data.name}
                        className="mt-1 block w-full"
                        autoComplete="name"
                        placeholder="Full Name"
                        error={errors.name}
                        autoFocus={true}
                        onChange={(e) => setData('name', e.target.value)}
                    />
                    <div className='mt-4'>
                        <Input
                            id="email"
                            label="Email"
                            name="email"
                            placeholder="Email Address"
                            error={errors.email}
                            value={data.email}
                            className="mt-1 block w-full"
                            autoComplete="username"
                            onChange={(e) => setData('email', e.target.value)}
                        />
                    </div>

                    <div className="mt-4">
                        <InputLabel htmlFor="password" value="Password" />
                        <Password
                            id="password"
                            type="password"
                            invalid={errors.password !== undefined}
                            name="password"
                            placeholder="Create a strong password"
                            value={data.password}
                            toggleMask
                            onChange={(e) => setData('password', e.target.value)}
                        />
                        <InputError message={errors.password} className="mt-2" />
                    </div>

                    <div className="mt-4">
                        <InputLabel
                            htmlFor="password_confirmation"
                            value="Confirm Password"
                        />
                        <Password
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            invalid={errors.password_confirmation !== undefined}
                            placeholder="Confirm password"
                            value={data.password_confirmation}
                            toggleMask
                            className="mt-1 block w-full"
                            onChange={(e) =>
                                setData('password_confirmation', e.target.value)
                            }
                        />
                        <InputError
                            message={errors.password_confirmation}
                            className="mt-2"
                        />
                    </div>

                    <div className="mt-4 flex items-center justify-end gap-3">
                        <Link
                            href={route('login')}
                            className="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                        >
                            Already registered?
                        </Link>

                        <Button loading={processing}>
                            Register
                        </Button>
                    </div>
                </form>

            </Card>
        </GuestLayout>
    );
}
