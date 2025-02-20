import useBreakpoint from "@/Hooks/useBrakpoints";
import { cn, getQuery } from "@/utils";
import { Link, useForm } from "@inertiajs/react";
import { FormEventHandler, HTMLAttributes, HTMLProps, useEffect, useRef } from "react";
import { toast } from 'react-hot-toast'

export const PasswordInput = ({ onChange, placeholder, required, value, ...props }: { onChange: (...args: any) => any, value?: string, placeholder?: string, props?: any, required?: boolean }) => {
    const [passwordVisible, setPasswordVisible] = useState(false);
    return (
        <div className="input-box">
            <input
                type={passwordVisible ? 'text' : 'password'}
                placeholder={placeholder}
                onChange={onChange}
                required={required}
                value={value}
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
    const { min, max } = useBreakpoint()
    const { data, setData, post, processing, errors, reset } = useForm({
        email: '',
        password: '',
        remember: false as boolean,
    });
    const container = useRef<HTMLDivElement>(null);
    const registerBtn = useRef<HTMLButtonElement>(null);
    const loginBtn = useRef<HTMLButtonElement>(null);

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route('login'), {
            onFinish: () => reset('password')
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
            <main className="main-div">
                <div className={cn("auth-container", getQuery('register') && 'active')} ref={container}>
                    <div className="form-box login">
                        <form onSubmit={submit} className="form">
                            <span className="font-bold text-lg md:text-2xl text-gray-700 my-auto">Sign in to your account</span>

                            <div className="input-box">
                                <input
                                    onChange={(e) => setData('email', e.target.value)}
                                    type="email"
                                    value={data.email}
                                    placeholder="Email"
                                    required
                                />
                                <i className="bx bxs-user"></i>
                            </div>
                            {errors.email && <InputError message={errors.email} className="mt-2" />}
                            <PasswordInput
                                onChange={(e: any) => setData('password', e.target.value)}
                                value={data.password}
                                placeholder="Password" required />
                            {errors.password && <InputError message={errors.password} className="mt-2" />}
                            <div className="flex items-center justify-between -!mt-5 mb-2">
                                <div className="text-gray-600 flex items-center gap-1">
                                    <Checkbox id="remember" name="remember" checked={data.remember} onChange={(e) => setData('remember', e.target.checked)} />
                                    <label htmlFor="remember" className="text-gray-600 mb-0">Remember Me</label>
                                </div>
                                <div className="text-gray-600">
                                    <Link href={route('password.request')}>Forgot Password?</Link>
                                </div>
                            </div>
                            <button type="submit" className="auth-btn">
                                Login
                            </button>
                            {max('md') && <button onClick={() => {
                                container.current?.classList.add('active');
                            }}
                                type="button" className="mt-2">Don't have an account? <span className="text-primary font-semibold">Register</span></button>
                            }
                            <div className="mb-auto"></div>
                        </form>
                    </div>

                    <RegisterForm>
                        {max('md') && <button onClick={() => {
                            container.current?.classList.remove('active');
                        }}
                            type="button" className="">Already have an account? <span className="text-primary font-semibold">Login</span> </button>
                        }
                    </RegisterForm>

                    {min('md') && <div className="toggle-box">
                        <div className="toggle-panel toggle-left">
                            <h1>Welcome Back!</h1>
                            <p>Don't have an account?</p>
                            <button className="p-button bg-transparent rounded-lg text-white border-white border-2 px-3" ref={registerBtn}>
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
        </>
    );
}
