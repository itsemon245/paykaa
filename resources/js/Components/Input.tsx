import { InputText, InputTextProps } from 'primereact/inputtext'
import React from 'react'

export default function Input({
    id,
    error = undefined,
    invalid,
    label,
    ...props
}: InputTextProps & { label: string, error: string | undefined }) {
    return (
        <>
            <InputLabel htmlFor={id} value={label} />
            <InputText
                invalid={invalid || error !== undefined}
                {...props}
            />
            <InputError message={error} className="mt-2" />
        </>
    )
}

