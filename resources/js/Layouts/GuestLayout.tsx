import ApplicationLogo from '@/Components/ApplicationLogo';
import { Link } from '@inertiajs/react';
import { PropsWithChildren } from 'react';
import BaseLayout from './BaseLayout';

export default function Guest({ children }: PropsWithChildren) {
    return (
        <BaseLayout>
            Guest Layout
            {children}
        </BaseLayout>
    );
}
