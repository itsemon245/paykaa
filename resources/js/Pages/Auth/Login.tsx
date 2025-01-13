import { cn } from "@/utils";
import { Link, useForm } from "@inertiajs/react";
import { FormEventHandler, HTMLAttributes, HTMLProps, useEffect, useRef } from "react";
import { toast } from 'react-hot-toast'

export const PasswordInput = ({ onChange, placeholder, required, ...props }: { onChange: (...args: any) => any, placeholder?: string, props?: any, required?: boolean }) => {
    const [passwordVisible, setPasswordVisible] = useState(false);
    return (
        <div className="input-box">
            <input
                type={passwordVisible ? 'text' : 'password'}
                placeholder={placeholder}
                onChange={onChange}
                required={required}
                {...props}
            />
            <div className="cursor-pointer">
                {!passwordVisible && <i className={cn("bx bxs-show", !passwordVisible && 'hidden')} onClick={() => setPasswordVisible(!passwordVisible)}></i>
                }
                {passwordVisible && <i className={cn("bx bxs-hide", passwordVisible && 'hidden')} onClick={() => setPasswordVisible(!passwordVisible)}></i>
                }
            </div>
        </div>
    )
}

export default function Login() {
    const preloader = useRef<HTMLDivElement>(null);
    const { data, setData, post, processing, errors, reset } = useForm({
        email: '',
        password: '',
        remember: false,
    });
    const config = useConfig();
    const container = useRef<HTMLDivElement>(null);
    const registerBtn = useRef<HTMLButtonElement>(null);
    const loginBtn = useRef<HTMLButtonElement>(null);

    const autoFill = () => {
        if (config.app.env !== 'production') {
            setData('email', 'admin@mail.com');
            setData('password', '12345678');
        }
    };

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route('login'), {
            onFinish: () => reset('password'),
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
        <>
            <Head title="Login">
                <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
            </Head>
            <main>
                <div className="container" ref={container}>
                    <div className="form-box login">
                        <form onSubmit={submit}>
                            <h1>Login</h1>
                            <div className="input-box">
                                <input
                                    onChange={(e) => setData('email', e.target.value)}
                                    type="email"
                                    placeholder="Email"
                                    required
                                />
                                <i className="bx bxs-user"></i>
                            </div>
                            {errors.email && <InputError message={errors.email} className="mt-2" />}
                            <PasswordInput
                                onChange={(e: any) => setData('password', e.target.value)}
                                placeholder="Password" required />
                            {errors.password && <InputError message={errors.password} className="mt-2" />}
                            <div className="forgot-link">
                                <Link href={route('password.request')}>Forgot Password?</Link>
                            </div>
                            <button type="submit" className="btn">
                                Login
                            </button>
                        </form>
                    </div>

                    <RegisterForm />

                    <div className="toggle-box">
                        <div className="toggle-panel toggle-left">
                            <h1>Welcome Back!</h1>
                            <p>Don't have an account?</p>
                            <button className="btn register-btn" ref={registerBtn}>
                                Register
                            </button>
                        </div>
                        <div className="toggle-panel toggle-right">
                            <h1>Hello, Welcome!</h1>
                            <p>Already have an account?</p>
                            <button className="btn login-btn" ref={loginBtn}>
                                Login
                            </button>
                        </div>
                    </div>
                </div>
            </main>
        </>
    );
}
