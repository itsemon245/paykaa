import { Link, useForm } from "@inertiajs/react";
import { Button } from "primereact/button";
import { Card } from "primereact/card";
import { InputText } from "primereact/inputtext";
import { Password } from "primereact/password";
import { FormEventHandler } from "react";

export default function Login({
    status,
    canResetPassword,
}: {
    status?: string;
    canResetPassword: boolean;
}) {
    const { data, setData, post, processing, errors, reset } = useForm({
        email: 'admin@mail.com',
        password: '',
        remember: false,
    });
    const config = useConfig();

    const autoFill = () => {
        if (config.app.env !== 'production') {
            setData('email', 'admin@mail.com');
            setData('password', '12345678');
        }
    }

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route('login'), {
            onFinish: () => reset('password'),
        });
    };

    return (
        <GuestLayout>
            <Head title="Log in" />

            {status && (
                <div className="mb-4 text-sm font-medium text-green-600">
                    {status}
                </div>
            )}

            <Card className="min-w-[90vw] sm:min-w-[465px]">
                <img src="/assets/logo-short.png" className="mx-auto h-28 w-auto mb-3" alt="Paykaa Logo" />
                <form onSubmit={submit}>
                    <div>
                        <Input
                            id="email"
                            type="email"
                            name="email"
                            label="Email"
                            value={data.email}
                            placeholder="Email"
                            autoComplete="email"
                            error={errors.email}
                            autoFocus={true}
                            onChange={(e) => setData('email', e.target.value)}
                            required
                        />
                    </div>

                    <div className="mt-4">
                        <InputLabel htmlFor="password" value="Password" />
                        <Password placeholder="Password" required feedback={false} invalid={errors.password !== undefined} value={data.password} onChange={(e) => setData('password', e.target.value)} toggleMask />
                        <InputError message={errors.password} className="mt-2" />
                    </div>

                    <div className="flex mt-2 items-center justify-between">
                        <label className="inline-flex items-center mb-0">
                            <Checkbox
                                name="remember"
                                checked={data.remember}
                                onChange={(e) =>
                                    setData('remember', e.target.checked)
                                }
                            />
                            <span className="ms-2 text-sm text-gray-600 dark:text-gray-400">
                                Remember
                            </span>
                        </label>
                        <Link
                            href={route('password.request')}
                            className="font-medium rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                        >
                            Forgot your password?
                        </Link>
                    </div>
                    <div className="mt-4 flex items-center justify-between sm:justify-end gap-3">
                        <Link
                            href={route('register')}
                            className="font-medium rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                        >
                            Create an account
                        </Link>
                        <Button label="Login" loading={processing}>
                        </Button>
                    </div>
                </form>

            </Card>
        </GuestLayout>
    );
}
