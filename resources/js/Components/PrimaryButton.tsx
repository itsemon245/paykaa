import { Button } from 'primereact/button';
import { ButtonHTMLAttributes } from 'react';

export default function PrimaryButton({
    className = '',
    disabled,
    children,
    ...props
}: ButtonHTMLAttributes<HTMLButtonElement>) {
    return (
        <Button
            {...props}
            disabled={disabled}
        >
            {children}
        </Button>
    );
}
