import ApplicationLogo from '@/Components/ApplicationLogo';
import { Link } from '@inertiajs/react';
import { PropsWithChildren } from 'react';
import BaseLayout from './BaseLayout';

export default function Guest({ children }: PropsWithChildren) {
    return (
        <BaseLayout>
            <div className="grid min-h-screen w-full items-center justify-center py-12 sm:px-6 lg:px-8">
                {children}
            </div>
        </BaseLayout>
    );
}
