import { PasswordInput } from "@/Pages/Auth/Login";
import { getQuery } from "@/utils";
import { useForm } from "@inertiajs/react";
import { FormEventHandler } from "react";
import toast from "react-hot-toast";

export default function RegisterForm({ children }: { children: any }) {
    const { data, setData, hasErrors, post, processing, errors, setError, clearErrors, reset } = useForm({
        name: '',
        email: getQuery('email') || '',
        password: '',
        password_confirmation: '',
    });

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
            return;
        }

        if (data.password === '') {
            setError('password', 'Password is required!')
            return;
        }
        if (data.password_confirmation === '') {
            setError('password_confirmation', 'Password confirmation is required!')
            return;
        }

        if (data.password !== data.password_confirmation) {
            setError('password', 'Passwords must match');
            setError('password_confirmation', 'Passwords must match');
            return;
        }

        if (hasErrors) {
            return;
        }
        post(route('register'), {
            onFinish: () => reset('password', 'password_confirmation'),
        });
    };
    return (
        <div className="form-box register">
            <form onSubmit={submit} className="form">
                <span className="font-bold text-lg md:text-xl text-gray-700">Create your PayKaa account</span>
                <div>
                    <div className="input-box">
                        <input type="text" placeholder="Full Name" required onChange={(e) => setData('name', e.target.value)} />
                        <i className='bx bxs-user'></i>
                    </div>
                    {errors.name && <InputError message={errors.name} className="mt-0 mb-1" />}
                </div>
                <div>
                    <div className="input-box">
                        <input type="email" value={data.email} placeholder="Email" required onChange={(e) => setData('email', e.target.value)} />
                        <i className='bx bxs-envelope'></i>
                    </div>
                    {errors.email && <InputError message={errors.email} className="mt-0 mb-1" />}
                </div>
                <div>
                    <PasswordInput placeholder="Password" required onChange={(e) => setData('password', e.target.value)} value={data.password} />
                    {errors.password && <InputError message={errors.password} className="mt-0 mb-1" />}
                </div>
                <div>
                    <PasswordInput placeholder="Confirm Password" required onChange={e => setData('password_confirmation', e.target.value)} value={data.password_confirmation} />
                    {errors.password_confirmation && <InputError message={errors.password_confirmation} className="mt-0 mb-1" />}
                </div>
                <button type="submit" className="auth-btn" disabled={processing}>{processing ? 'Processing ...' : 'Register'}</button>
                {children}
                {/*<p>or register with social platforms</p>
                            <div className="social-icons">
                                <a href="#"><i className='bx bxl-google'></i></a>
                                <a href="#"><i className='bx bxl-facebook'></i></a>
                                <a href="#"><i className='bx bxl-github'></i></a>
                                <a href="#"><i className='bx bxl-linkedin'></i></a>
                            </div>*/}
            </form>
        </div>

    )
}

