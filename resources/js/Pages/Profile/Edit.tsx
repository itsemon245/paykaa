import { Head, useForm } from '@inertiajs/react';
import UpdatePasswordForm from './Partials/UpdatePasswordForm';
import UpdateProfileInformation from './Partials/UpdateProfileInformationForm';
import VerifyDocuments from './Partials/VerifyDocuments';
import { FormEventHandler } from 'react';
import { UserData } from '@/types/_generated';
import toast from 'react-hot-toast';

export interface UpdateProfileFormProps {
    name: string;
    avatar: string | File;
    email: string;
    gender: string | undefined;
    date_of_birth: string | undefined;
    country: string;
    address: string | undefined;
    phone: string | undefined;
}

export default function Edit() {
    const { user } = useAuth();
    const { data, setData, patch, errors, processing, recentlySuccessful, setError, clearErrors } =
        useForm({
            name: user.name,
            avatar: user.avatar as string | File,
            email: user.email,
            gender: user.gender,
            date_of_birth: user.date_of_birth,
            country: user.country || 'Bangladesh',
            address: user.address,
            phone: user.phone,
        });
    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        patch(route('profile.update'), {
            onSuccess: () => {
                toast.success('Profile Updated Successfully!')
            },
            onError: (errors) => {
                toast.error('Something went wrong!')
                console.log("Something went wrong", errors);
            },
        });
    };

    return (
        <>
            <Head title="Profile" />
            <div className="grid sm:grid-cols-2 lg:grid-cols-3 gap-5 justify-center px-3">
                <UpdateProfileInformation data={data} setData={setData} submit={submit} errors={errors} processing={processing} recentlySuccessful={recentlySuccessful} />
                <VerifyDocuments updateProfile={patch} profileData={data} setProfileError={setError} clearProfileErrors={clearErrors} />
                <UpdatePasswordForm />
            </div>
        </>
    );
}
