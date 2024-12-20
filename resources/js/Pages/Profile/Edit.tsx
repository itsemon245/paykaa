import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { PageProps } from '@/types';
import { Head } from '@inertiajs/react';
import DeleteUserForm from './Partials/DeleteUserForm';
import UpdatePasswordForm from './Partials/UpdatePasswordForm';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm';
import { Tag } from 'primereact/tag';
import { FloatLabel } from 'primereact/floatlabel';
import { InputText } from 'primereact/inputtext';
import { Card } from 'primereact/card';
import { Calendar } from 'primereact/calendar';
import { parseISO } from 'date-fns';

export default function Edit({
    mustVerifyEmail,
    status,
}: PageProps<{ mustVerifyEmail: boolean; status?: string }>) {
    const { user } = useAuth();
    return (
        <>
            <Head title="Profile" />
            <Navbar />
            <SquareBg className="max-h-screen" />
            <div className="px-4 mt-5 flex flex-col gap-2 justify-center max-w-7xl mx-auto">
                <InputLabel className='!text-white text-md !font-bold' value="Personal Data:" />
                <div className="flex items-center gap-2">
                    <div className='relative'>
                        <img src={user.avatar} className="w-20 rounded-full" alt="Avatar" />
                        <div className="absolute top-0 right-0 bg-primary-gradient p-1 rounded-full flex items-center justify-center">
                            <HeroiconsCameraSolid className="w-5 h-5" />
                        </div>
                    </div>

                    <div className="flex flex-col leading-5 text-white">
                        <div className="font-bold">{user.email}</div>
                        <div className="font-medium">ID: {user.id}</div>
                        {!user.email_verified_at && <Tag className="w-max" icon="pi pi-exclamation-triangle" severity="warning" value="Not Verified"></Tag>}
                        {user.email_verified_at && <Tag className="w-max" icon="pi pi-check" severity="success" value="Verified"></Tag>}
                    </div>
                </div>
                <div className='flex flex-col gap-2'>
                    <div>
                        <label className='text-white font-bold'>Name</label>
                        <InputText className="!bg-transparent !text-white" value={user.name} />
                    </div>
                    <div>
                        <label className='text-white font-bold'>Email</label>
                        <InputText className="!bg-transparent !text-white" value={user.email} />
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
