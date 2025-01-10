import { useForm } from "@inertiajs/react";
import toast from "react-hot-toast";

export default function RegisterForm() {
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
    useEffect(() => {
        if (errors.length > 0) {
            errors.forEach(error => {
                toast.error(error.message)
            })
        }
    }, [errors])

    return (
        <div className="form-box register">
            <form onSubmit={submit}>
                <h1>Register</h1>
                <div className="input-box">
                    <input type="text" placeholder="Full Name" required onChange={(e) => setData('name', e.target.value)} />
                    <i className='bx bxs-user'></i>
                </div>
                <div className="input-box">
                    <input type="email" placeholder="Email" required onChange={(e) => setData('email', e.target.value)} />
                    <i className='bx bxs-envelope'></i>
                </div>
                <div className="input-box">
                    <input type="text" placeholder="Password" required onChange={(e) => setData('password', e.target.value)} />
                    <i className='bx bxs-lock-alt' ></i>
                </div>
                <div className="input-box">
                    <input type="text" placeholder="Confirm Password" required onChange={(e) => setData('password_confirmation', e.target.value)} />
                    <i className='bx bxs-lock-alt' ></i>
                </div>
                <button type="submit" className="btn">Register</button>
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

