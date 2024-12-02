import { Head as InertiaHead } from '@inertiajs/react';
interface HeadProps {
    children?: React.ReactNode | undefined;
    title: string;
}
export default function Head({ children, title }: HeadProps) {
    return (
        <InertiaHead title={title}>
            {children}
        </InertiaHead>
    )
}
