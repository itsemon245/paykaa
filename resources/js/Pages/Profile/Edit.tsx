import { Head } from '@inertiajs/react';
import UpdatePasswordForm from './Partials/UpdatePasswordForm';
import UpdateProfileInformation from './Partials/UpdateProfileInformationForm';
import VerifyDocuments from './Partials/VerifyDocuments';

export default function Edit() {
    return (
        <>
            <Head title="Profile" />
            <div className="grid sm:grid-cols-2 lg:grid-cols-3 gap-5 justify-center px-3">
                <UpdateProfileInformation />
                <VerifyDocuments />
                <UpdatePasswordForm />
            </div>
        </>
    );
}
