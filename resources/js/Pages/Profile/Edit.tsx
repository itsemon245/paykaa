import { PageProps } from '@/types';
import { Head } from '@inertiajs/react';
import { Tag } from 'primereact/tag';
import { Dropdown } from 'primereact/dropdown';
import { Calendar } from 'primereact/calendar';
import { subYears } from 'date-fns';

export default function Edit({
    mustVerifyEmail,
    status,
}: PageProps<{ mustVerifyEmail: boolean; status?: string }>) {
    const { user } = useAuth();
    return (
        <>
            <Head title="Profile" />
            <div className="px-4 mt-5 flex flex-col gap-2 justify-center max-w-xl mx-auto">
                <InputLabel className='!text-gray-800 text-md !font-bold' value="Personal Data:" />
                <div className="flex items-center gap-2">
                    <div className='relative'>
                        <img src={user.avatar} className="w-20 rounded-full" alt="Avatar" />
                        <div className="absolute top-0 right-0 p-1 rounded-full flex items-center justify-center">
                            <HeroiconsCameraSolid className="w-5 h-5" />
                        </div>
                    </div>

                    <div className="flex flex-col leading-5 text-gray-800">
                        <div className="font-bold">{user.email}</div>
                        <div className="font-medium">ID: {user.id}</div>
                        {!user.email_verified_at && <Tag className="w-max" icon="pi pi-exclamation-triangle" severity="warning" value="Not Verified"></Tag>}
                        {user.email_verified_at && <Tag className="w-max" icon="pi pi-check" severity="success" value="Verified"></Tag>}
                    </div>
                </div>
                <div className='flex flex-col gap-3 mt-5'>
                    <Input label='Name' placeholder='Enter your name' value={user.name} />
                    <Input label='Email' value={user.email} placeholder='Enter your email' />
                    <Input label='Phone' value={user.phone} placeholder='Enter your phone' />
                    <Input label='Country' value={user.country} placeholder='Enter your country' />
                    <Input label='Address' value={user.address} placeholder='Enter your address' />
                    {/*<div>
                        <InputLabel value="Date of Birth" />
                        <Calendar showButtonBar className='w-full' value={user.date_of_birth ? new Date(user.date_of_birth) : null} placeholder="Select your date of birth" dateFormat='M dd, yy' maxDate={subYears(new Date(), 12)} />
                    </div>
                    */}
                    <div>
                        <InputLabel value="Gender" />
                        <Dropdown options={[{
                            name: 'Male',
                            value: 'male',
                        }, {
                            name: 'Female',
                            value: 'female',
                        }]}
                            optionLabel="name"
                            placeholder="Select your gender" className='w-full' checkmark={true} highlightOnSelect={true} />
                    </div>
                </div>

            </div>
            {/*
            <div className="py-6">
                <div className="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                    <div className="bg-white p-4 shadow sm:rounded-lg sm:p-8 dark:bg-gray-800">
                        <UpdateProfileInformationForm
                            mustVerifyEmail={mustVerifyEmail}
                            status={status}
                            className="max-w-xl"
                        />
                    </div>

                    <div className="bg-white p-4 shadow sm:rounded-lg sm:p-8 dark:bg-gray-800">
                        <UpdatePasswordForm className="max-w-xl" />
                    </div>

                    <div className="bg-white p-4 shadow sm:rounded-lg sm:p-8 dark:bg-gray-800">
                        <DeleteUserForm className="max-w-xl" />
                    </div>
                </div>
            </div>
            */}
        </>
    );
}
