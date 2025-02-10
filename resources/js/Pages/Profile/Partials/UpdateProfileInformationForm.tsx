import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Transition } from '@headlessui/react';
import { Link, router, SetData, useForm, usePage } from '@inertiajs/react';
import { ChangeEvent, FormEventHandler, HTMLProps } from 'react';
import { Tag } from 'primereact/tag';
import { Dropdown, DropdownProps } from 'primereact/dropdown';
import { Calendar } from 'primereact/calendar';
import { subYears } from 'date-fns';
import { KycData, UserData } from '@/types/_generated';
import toast from 'react-hot-toast';
import { PageProps } from '@/types';
import { Tooltip } from 'primereact/tooltip';
import { cn, copyToClipboard, image } from '@/utils';
import countries from '@/data/countries';
import { SelectItemOptionsType } from 'primereact/selectitem';
import { UpdateProfileFormProps } from '../Edit';

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
        <button id={id} type="button" className='relative z-10' onClick={verifyEmail}>
            {!user.email_verified_at && <Tag className="w-max text-xs" icon="pi pi-exclamation-triangle" severity="warning" value={loading ? 'Sending...' : 'Click to verify'}></Tag>}
            {user.email_verified_at && <Tag className="w-max text-xs" icon="pi pi-check" severity="success" value="Verified"></Tag>}
        </button>
    </div>
}

interface UpdateProfileInformationProps {
    data: UpdateProfileFormProps;
    setData: (...args: any[]) => void;
    submit: FormEventHandler;
    errors: Record<string, string>;
    processing: boolean;
    recentlySuccessful: boolean;
}
export default function UpdateProfileInformation({ data, setData, submit, errors, processing, recentlySuccessful }: UpdateProfileInformationProps) {
    const { user } = useAuth();
    const kyc = usePage().props.kyc as KycData | undefined;
    const csrf_token = usePage().props.csrfToken
    const { balance } = useBalance();

    const selectedCountryTemplate = (option?: typeof countries[number], props?: DropdownProps) => {
        if (option) {
            return (
                <div className="flex align-items-center">
                    <img alt={option.name} src={`https://api.iconify.design/flag:${option.code.toLowerCase()}-4x3.svg`} className={`mr-2`} style={{ width: '18px' }} />
                    <div>{option.name}</div>
                </div>
            );
        }

        return <span>{props?.placeholder}</span>;
    };

    const countryOptionTemplate = (option: typeof countries[number]) => {
        return (
            <div className="flex align-items-center">
                <img alt={option.name} src={`https://api.iconify.design/flag:${option.code.toLowerCase()}-4x3.svg`} className="mr-2" style={{ width: '18px' }} />
                <div>{option.name}</div>
            </div>
        );
    };

    const [preview, setPreview] = useState<string | undefined>(undefined);
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
                <label htmlFor='avatar' className='relative cursor-pointer'>
                    <input className='hidden' type="file" name="avatar" id="avatar" onChange={uploadAvatar} />
                    <img src={preview || image(user.avatar as string)} onError={(e) => e.target.src = defaultAvatar} className="w-20 aspect-square object-cover rounded-full" alt="Avatar" />
                    <div className="absolute top-0 right-0 p-1 rounded-full flex items-center justify-center">
                        <HeroiconsCameraSolid className="w-5 h-5" />
                    </div>
                </label>

                <div className="flex flex-col leading-5 gap-1 text-gray-800">
                    {/*<div className="font-bold">{user.email}</div>*/}
                    <div className="font-medium flex items-center gap-1">UID:
                        <div className="flex gap-2 items-center ">
                            <label className="text-sm font-bold mb-0 !text-gray-800">{user.id}</label>
                            <HugeiconsCopy01 className="w-4 h-4 !text-gray-800 cursor-pointer" onClick={() => copyToClipboard(user.id)} />
                        </div>
                    </div>
                    <div className="font-medium">Balance: {balance}</div>
                    <Tag className="w-max text-xs" icon="pi pi-user" severity={
                        kyc ?
                            (kyc.approved_at ? 'success' : (kyc.rejected_at ? 'danger' : 'warning'))
                            : 'danger'}
                        value={
                            kyc ?
                                (kyc.approved_at ? 'Verified' : (kyc.rejected_at ? 'Rejected' : 'Pending'))
                                : 'Not Verified'} />
                </div>
            </div>
            <div className='flex flex-col gap-3 !mt-5'>
                <Input color="gray-700" label='Name' value={data.name} onChange={e => setData('name', e.target.value)} error={errors.name} disabled={kyc?.approved_at != undefined} />
                <div className="relative">
                    <div className="absolute right-3 top-3">
                        <EmailVerifiedTag user={user} id="email-verified-tag" />
                    </div>
                    <Input className={cn(user.email_verified_at && 'border-green-500')} invalid={!user.email_verified_at} error={errors.email} color="gray-700" label='Email' value={data.email} onChange={e => setData('email', e.target.value)} disabled={true} />
                </div>
                <Input color="gray-700" label='Date of Birth' value={data.date_of_birth} onChange={e => setData('date_of_birth', e.target.value)} type="date" max={subYears(new Date(), 12).toISOString().split('T')[0]} error={errors.date_of_birth} disabled={kyc?.approved_at != null} />
                <div>
                    <InputLabel value="Country" />
                    {/*@ts-ignore */}
                    <Dropdown filter={true} filterBy='name,code' value={data.country} onChange={(e) => setData('country', e.value)} options={countries} optionLabel="name" optionValue='name' placeholder="Select a Country"
                        disabled={kyc?.approved_at != undefined}
                        valueTemplate={selectedCountryTemplate} itemTemplate={countryOptionTemplate} className="w-full"
                    />
                    {errors.country && <div className="text-red-500">{errors.country}</div>}
                </div>
                <Input color="gray-700" label='Address' value={data.address} onChange={e => setData('address', e.target.value)} error={errors.address} disabled={kyc?.approved_at != null} />
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
                            onChange={(e) => setData('gender', e.value)}
                            value={data.gender}
                            placeholder="Select Gender"
                            optionLabel="name" className='w-full' checkmark={true} highlightOnSelect={true} disabled={kyc?.approved_at != null} />
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
