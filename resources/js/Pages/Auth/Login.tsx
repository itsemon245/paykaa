import { Link, useForm } from "@inertiajs/react";
import { Button } from "primereact/button";
import { Card } from "primereact/card";
import { InputText } from "primereact/inputtext";
import { Password } from "primereact/password";
import { FormEventHandler } from "react";
import './login.css';

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
    const config = useConfig();
    const container = useRef<HTMLDivElement>(null);
    const registerBtn = useRef<HTMLButtonElement>(null);
    const loginBtn = useRef<HTMLButtonElement>(null);

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
    useEffect(() => {
        registerBtn.current?.addEventListener('click', () => {
            container.current?.classList?.add('active');
        });

        loginBtn.current?.addEventListener('click', () => {
            container.current?.classList.remove('active');
        });
    }, [loginBtn, registerBtn, container]);

    useEffect(() => {
        if (errors.length > 0) {
            errors.forEach(error => {
                toast.error(error.message)
            })
        }
    }, [errors])


    return (
        <BaseLayout>
            <Head title="Login">
                <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet' />
            </Head >
            <main>
                <div className="container" ref={container}>
                    <div className="form-box login">
                        <form onSubmit={submit}>
                            <h1>Login</h1>
                            <div className="input-box">
                                <input onChange={(e) => setData('email', e.target.value)} type="email" placeholder="Email" required />
                                <i className='bx bxs-user'></i>
                            </div>
                            <div className="input-box">
                                <input type="password" placeholder="Password" required onChange={(e) => setData('password', e.target.value)} />
                                <i className='bx bxs-lock-alt' ></i>
                            </div>
                            <div className="forgot-link">
                                <Link href={route('password.request')}>Forgot Password?</Link>
                            </div>
                            <button type="submit" className="btn">Login</button>
                            {/*<p>or login with social platforms</p>
                            <div className="social-icons">
                                <a href="#"><i className='bx bxl-google'></i></a>
                                <a href="#"><i className='bx bxl-facebook'></i></a>
                                <a href="#"><i className='bx bxl-github'></i></a>
                                <a href="#"><i className='bx bxl-linkedin'></i></a>
                            </div>*/}
                        </form>
                    </div>

                    <RegisterForm />

                    <div className="toggle-box">
                        <div className="toggle-panel toggle-left">
                            <h1>Welcome Back!</h1>
                            <p>Don't have an account?</p>
                            <button className="btn register-btn" ref={registerBtn}>Register</button>
                        </div>
                        <div className="toggle-panel toggle-right">
                            <h1>Hello, Welcome!</h1>
                            <p>Already have an account?</p>
                            <button className="btn login-btn" ref={loginBtn}>Login</button>
                        </div>
                    </div>
                </div>

            </main>
        </BaseLayout>
    );
}
