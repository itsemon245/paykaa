import { Button, ButtonProps } from 'primereact/button';
import { ButtonHTMLAttributes } from 'react';

export default function PrimaryButton({
    className = '',
    disabled,
    children,
    ...props
}: ButtonProps) {
    return (
        <Button
            {...props}
            disabled={disabled}
        >
            {children}
        </Button>
    );
}
