import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Transition } from '@headlessui/react';
import { Link, router, useForm, usePage } from '@inertiajs/react';
import { ChangeEvent, FormEventHandler, HTMLProps } from 'react';
import { Tag } from 'primereact/tag';
import { Dropdown } from 'primereact/dropdown';
import { Calendar } from 'primereact/calendar';
import { subYears } from 'date-fns';
import { KycData, UserData } from '@/types/_generated';
import toast from 'react-hot-toast';
import { PageProps } from '@/types';
import { Tooltip } from 'primereact/tooltip';
import { image } from '@/utils';

const EmailVerifiedTag = ({ user, id, ...props }: HTMLProps<HTMLDivElement> & { user: UserData, id?: string }) => {
    const [loading, setLoading] = useState(false);
    const verifyEmail = async () => {
        if (user.email_verified_at) {
            toast.success('Email already verified');
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
        <button id={id} type="button" className='relative' onClick={verifyEmail}>
            {!user.email_verified_at && <Tag className="w-max text-xs" icon="pi pi-exclamation-triangle" severity="warning" value={loading ? 'Sending...' : 'Click to verify'}></Tag>}
            {user.email_verified_at && <Tag className="w-max text-xs" icon="pi pi-check" severity="success" value="Verified"></Tag>}
        </button>
    </div>
}

export default function UpdateProfileInformation() {
    const { user } = useAuth();
    const kyc = usePage().props.kyc as KycData | undefined;
    const csrf_token = usePage().props.csrf_token as string;
    const { balance } = useBalance();

    const { data, setData, patch, errors, processing, recentlySuccessful } =
        useForm({
            name: user.name,
            avatar: user.avatar as string | File,
            email: user.email,
            gender: user.gender,
            date_of_birth: user.date_of_birth,
            country: user.country,
            address: user.address,
            phone: user.phone,
        });
    const [preview, setPreview] = useState<string | undefined>(undefined);
    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        patch(route('profile.update'));
    };

    const uploadAvatar = async (e: ChangeEvent<HTMLInputElement>) => {
        const file = e.target.files?.[0];
        setPreview(URL.createObjectURL(file as Blob));
        if (!file) {
            return;
        }
        const formData = new FormData();
        formData.append('avatar', file);
        formData.append('_token', csrf_token)
        formData.append('_method', 'patch');
        const toastId = toast.loading('Updating Avatar...')
        const res = await fetch(route('profile.update.avatar'), {
            method: 'post',
            body: formData,
        });
        if (!res.ok) {
            toast.dismiss(toastId)
            toast.error('Failed to update avatar')
            console.log("Error updating avatar", res);
            return;
        }
        const data = await res.json();
        if (data.success) {
            toast.dismiss(toastId)
            toast.success('Avatar Updated Successfully!')
            return;
        } else {
            toast.dismiss(toastId)
            toast.error('Something went wrong!')
            console.log("Something went wrong", data);
            return;
        }
    }

    return (
        <form onSubmit={submit} className="flex flex-col gap-2 w-full justify-center mx-auto">
            <InputLabel className='!text-gray-800 text-md !font-bold' value="Personal Data:" />
            <div className="flex items-center gap-2">
                <label htmlFor='avatar' className='relative'>
                    <input className='hidden' type="file" name="avatar" id="avatar" onChange={uploadAvatar} />
                    <img src={preview || image(user.avatar as string)} className="w-20 rounded-full" alt="Avatar" />
                    <div className="absolute top-0 right-0 p-1 rounded-full flex items-center justify-center">
                        <HeroiconsCameraSolid className="w-5 h-5" />
                    </div>
                </label>

                <div className="flex flex-col leading-5 gap-1 text-gray-800">
                    <div className="font-bold">{user.email}</div>
                    <div className="font-medium">Unique ID: {user.id}</div>
                    <div className="font-medium">Balance: {balance}</div>
                    <Tag className="w-max text-xs" icon="pi pi-user" severity={kyc?.approved_at ? 'success' : 'danger'} value={kyc?.approved_at ? 'Verified' : 'Not Verified'} />
                </div>
            </div>
            <div className='flex flex-col gap-3 mt-5'>
                <Input color="gray-700" label='Name' value={data.name} onChange={e => setData('name', e.target.value)} error={errors.name} />
                <div className="relative">
                    <div className="absolute right-3 top-3">
                        <EmailVerifiedTag user={user} id="email-verified-tag" />
                    </div>
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
