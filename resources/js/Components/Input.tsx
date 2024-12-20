import { InputProps } from '@headlessui/react'
import { InputNumber, InputNumberProps } from 'primereact/inputnumber'
import { InputText, InputTextProps } from 'primereact/inputtext'

export default function Input({
    id,
    error = undefined,
    invalid,
    label,
    ...props
}: InputTextProps & { label?: string, error?: string | undefined }) {
    return (
        <div>
            <InputLabel htmlFor={id} value={label} />
            <InputText
                invalid={invalid || error !== undefined}
                {...props as InputTextProps}
            />
            <InputError message={error} className="mt-2" />
        </div>
    )
}

