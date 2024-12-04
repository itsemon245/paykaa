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
        email: '',
        password: '',
        remember: false,
    });

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
                        />
                    </div>

                    <div className="mt-4">
                        <InputLabel htmlFor="password" value="Password" />
                        <Password placeholder="Password" feedback={false} invalid={errors.password !== undefined} value={data.password} onChange={(e) => setData('password', e.target.value)} toggleMask />
                        <InputError message={errors.password} className="mt-2" />
                    </div>

                    <div className="mt-4 block">
                        <label className="flex items-center">
                            <Checkbox
                                name="remember"
                                checked={data.remember}
                                onChange={(e) =>
                                    setData('remember', e.target.checked)
                                }
                            />
                            <span className="ms-2 text-sm text-gray-600 dark:text-gray-400">
                                Remember me
                            </span>
                        </label>
                    </div>

                    <div className="mt-4 flex items-center justify-end gap-3">
                        {canResetPassword && (
                            <Link
                                href={route('password.request')}
                                className="font-medium rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                            >
                                Forgot your password?
                            </Link>
                        )}

                        <Button className="ms-4" loading={processing}>
                            Log in
                        </Button>
                    </div>
                </form>

            </Card>
        </GuestLayout>
    );
}
