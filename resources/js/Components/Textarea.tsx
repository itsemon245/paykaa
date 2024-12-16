import { InputTextarea, InputTextareaProps } from 'primereact/inputtextarea'

export default function Input({
    id,
    error = undefined,
    invalid,
    label,
    ...props
}: InputTextareaProps & { label: string, error: string | undefined }) {
    return (
        <div>
            <InputLabel htmlFor={id} value={label} />
            <InputTextarea
                invalid={invalid || error !== undefined}
                {...props}
            />
            <InputError message={error} className="mt-2" />
        </div>
    )
}

