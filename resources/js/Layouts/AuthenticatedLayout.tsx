import { PropsWithChildren, ReactNode, useState } from 'react';
import BaseLayout from './BaseLayout';

export default function Authenticated({
    children,
}: { children?: any }) {
    return (
        <BaseLayout>
            {children}
        </BaseLayout>
    );
}
