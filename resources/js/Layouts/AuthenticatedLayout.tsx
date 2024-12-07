import { PropsWithChildren, ReactNode, useState } from 'react';
import BaseLayout from './BaseLayout';

export default function Authenticated({
    header,
    children,
}: PropsWithChildren<{ header?: ReactNode }>) {
    return (
        <BaseLayout>
            {children}
        </BaseLayout>
    );
}
