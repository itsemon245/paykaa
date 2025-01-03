import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Transition } from '@headlessui/react';
import { Link, router, useForm, usePage } from '@inertiajs/react';
import { FormEventHandler, HTMLProps } from 'react';
import { Tag } from 'primereact/tag';
import { Dropdown } from 'primereact/dropdown';
import { Calendar } from 'primereact/calendar';
import { subYears } from 'date-fns';
import { UserData } from '@/types/_generated';
import toast from 'react-hot-toast';
import { PageProps } from '@/types';
import { Tooltip } from 'primereact/tooltip';

const EmailVerifiedTag = ({ user, id, ...props }: HTMLProps<HTMLDivElement> & { user: UserData, id?: string }) => {
    const [loading, setLoading] = useState(false);
    const verifyEmail = async () => {
        if (user.email_verified_at) {
            return;
        }
        const toastId = toast.loading('Sending verification email...');
        setLoading(true);
        router.visit(route('verification.send'), {
            method: 'post',
            preserveScroll: true,
            onSuccess: (data) => {
                console.log(data);
                toast.dismiss(toastId);
                toast.success(<p className='text-center'>A verification email has been sent to your email address</p>, {
                    duration: 5000,
                });
                console.log("Verification email sent");
                setLoading(false);
                return;
            },
            onError: (errors) => {
                toast.dismiss(toastId);
                toast.error('Failed to send verification email');
                console.log("Error sending verification email", errors);
                setLoading(false);
                return;
            },
        });
    }
    return <div {...props}>
        {id && <Tooltip target={"#" + id} content={user.email_verified_at ? 'Verified' : 'Click to send verification email'} />}
        <button id={id} type="button" onClick={verifyEmail}>
            {!user.email_verified_at && <Tag className="w-max text-xs" icon="pi pi-exclamation-triangle" severity="warning" value={loading ? 'Sending...' : 'Not Verified'}></Tag>}
            {user.email_verified_at && <Tag className="w-max text-xs" icon="pi pi-check" severity="success" value="Verified"></Tag>}
        </button>
    </div>
}

export default function UpdateProfileInformation() {
    const { user } = useAuth();
    const { balance } = useBalance();

    const { data, setData, patch, errors, processing, recentlySuccessful } =
        useForm({
            name: user.name,
            email: user.email,
            gender: user.gender,
            date_of_birth: user.date_of_birth,
            country: user.country,
            address: user.address,
            phone: user.phone,
        });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        patch(route('profile.update'));
    };

    return (
        <form onSubmit={submit} className="flex flex-col gap-2 w-full justify-center mx-auto">
            <InputLabel className='!text-gray-800 text-md !font-bold' value="Personal Data:" />
            <div className="flex items-center gap-2">
                <div className='relative'>
                    <img src={user.avatar} className="w-20 rounded-full" alt="Avatar" />
                    <div className="absolute top-0 right-0 p-1 rounded-full flex items-center justify-center">
                        <HeroiconsCameraSolid className="w-5 h-5" />
                    </div>
                </div>

                <div className="flex flex-col leading-5 gap-1 text-gray-800">
                    <div className="font-bold">{user.email}</div>
                    <div className="font-medium">Unique ID: {user.id}</div>
                    <div className="font-medium">Balance: {balance}</div>
                    <EmailVerifiedTag user={user} id="in-ui" />
                </div>
            </div>
            <div className='flex flex-col gap-3 mt-5'>
                <Input color="gray-700" label='Name' value={data.name} onChange={e => setData('name', e.target.value)} error={errors.name} />
                <div className="relative">
                    <EmailVerifiedTag user={user} className="absolute right-3 top-3" />
                    <Input invalid={!user.email_verified_at} error={errors.email} color="gray-700" label='Email' value={data.email} onChange={e => setData('email', e.target.value)} />
                </div>
                <Input color="gray-700" label='Date of Birth' value={data.date_of_birth} onChange={e => setData('date_of_birth', e.target.value)} type="date" max={subYears(new Date(), 12).toISOString().split('T')[0]} error={errors.date_of_birth} />
                <Input color="gray-700" label='Country' value={data.country} onChange={e => setData('country', e.target.value)} error={errors.country} />
                <Input color="gray-700" label='Address' value={data.address} onChange={e => setData('address', e.target.value)} error={errors.address} />
                <Input color="gray-700" label='Phone' value={data.phone} onChange={e => setData('phone', e.target.value)} error={errors.phone} />
                <div className="relative">
                    <div>
                        <InputLabel value="Gender" />
                        <Dropdown options={[{
                            name: 'Male',
                            value: 'male',
                        }, {
                            name: 'Female',
                            value: 'female',
                        }]}
                            optionLabel="name" className='w-full' checkmark={true} highlightOnSelect={true} />
                    </div>
                </div>
                <div className="flex items-center gap-4">
                    <PrimaryButton disabled={processing} loading={processing}>{processing ? 'Saving...' : 'Save Changes'}</PrimaryButton>

                    <Transition
                        show={recentlySuccessful}
                        enter="transition ease-in-out"
                        enterFrom="opacity-0"
                        leave="transition ease-in-out"
                        leaveTo="opacity-0"
                    >
                        <p className="text-sm text-gray-600 dark:text-gray-400">Saved</p>
                    </Transition>
                </div>
            </div>
        </form>
    );
}
