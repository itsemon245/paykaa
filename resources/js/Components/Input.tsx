import { cn } from '@/utils'
import { InputProps } from '@headlessui/react'
import { InputNumber, InputNumberProps } from 'primereact/inputnumber'
import { InputText, InputTextProps } from 'primereact/inputtext'

export default function Input({
    id,
    error = undefined,
    invalid,
    label,
    color,
    ...props
}: InputTextProps & { label?: string, error?: string | undefined, color?: string }) {
    const getKyeFilter = (type?: string) => {
        if (!type) {
            return undefined
        }
        if (props.keyfilter) return props.keyfilter
        const filters = {
            number: "num",
            email: "email",
        } as {
            [key: string]: InputTextProps['keyfilter']
        }
        return filters[type as keyof typeof filters]
    }
    return (
        <div>
            <InputLabel htmlFor={id} value={label} className={cn(color && 'text-' + color, "block w-full"} />
            <InputText
                keyfilter={getKyeFilter(props.type)}
                invalid={invalid || error !== undefined}
                {...props as InputTextProps}
            />
            <InputError message={error} className="mt-2" />
        </div>
    )
}

