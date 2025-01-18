import { AdditionalFields, FieldsData, WalletData, WithdrawMethodData } from "@/types/_generated";
import { SetData } from "@inertiajs/react";
import { InputNumber, InputNumberProps } from "primereact/inputnumber";
import { InputText, InputTextProps } from "primereact/inputtext";
import { InputTextarea } from "primereact/inputtextarea";
interface FieldProps {
    field: FieldsData;
    fieldStates: AdditionalFields[];
    setFieldStates: (fieldStates: AdditionalFields[]) => void;
    props?: Partial<InputNumberProps & InputTextProps>;
};

function FieldInput({ field, fieldStates, setFieldStates, ...props }: FieldProps) {
    const handleChange = (e: any, field: AdditionalFields) => {
        const fieldItem = fieldStates.find(item => item.name === field.name)
        let value = e.target.value
        if (fieldItem) {
            fieldStates.splice(fieldStates.indexOf(fieldItem), 1, {
                name: field.name,
                label: field.label,
                type: field.type,
                value: value,
            })
            return;
        } else {
            fieldStates.push({
                name: field.name,
                label: field.label,
                type: field.type,
                value: value,
            })
        }
        return
    }
    switch (field.type) {
        case "text":
            return <InputText onChange={e => handleChange(e, field)} type="text" placeholder={field.placeholder || field.label} required={field.required} className="w-full" {...props} />
        case "textarea":
            return <InputTextarea onChange={e => handleChange(e, field)} placeholder={field.placeholder || field.label} required={field.required} className="w-full" {...props} />
        default:
            return <InputText onChange={e => handleChange(e, field)} type={field.type} placeholder={field.placeholder || field.label} required={field.required} className="w-full" {...props} />
    }

}

interface WithdrawFormProps {
    data: Partial<WalletData>,
    setData: SetData<WalletData>,
    errors: Partial<Record<keyof WalletData, string>>,
    activeWithdrawalMethod?: WithdrawMethodData
}
export default function WithdrawForm({ data, setData, errors, activeWithdrawalMethod }: WithdrawFormProps) {
    const [fieldStates, setFieldStates] = useState<AdditionalFields[]>([]);
    useEffect(() => {
        setData('additional_fields', fieldStates)
    }, [fieldStates])

    return (<div className="flex flex-col justify-center items-center w-full my-2 gap-3 *:w-full">
        <div>
            <InputLabel value="Amount" />
            <InputNumber value={data.amount ? data.amount : null} onChange={e => setData('amount', e.value as number)} autoFocus={true} placeholder="Amount" className="w-full" invalid={errors.amount !== undefined} />
            <InputError message={errors.amount} />
        </div>
        <Input onChange={e => setData('payment_number', e.target.value)} error={errors.payment_number}
            label={activeWithdrawalMethod?.category === 'Cryptocurrency' ? 'Address' : (
                activeWithdrawalMethod?.category === 'Bank' ? 'A/C. No.' : 'Personal Nubmer'
            )}
            placeholder={activeWithdrawalMethod?.category === 'Cryptocurrency' ? '0xxd....' : (
                activeWithdrawalMethod?.category === 'Bank' ? 'A/C. No.' : 'Personal Nubmer'
            )}
            className="w-full" />
        {activeWithdrawalMethod?.fields?.map(field => (
            <div key={field.label}>
                <InputLabel value={field.label} />
                <FieldInput field={field} fieldStates={fieldStates} setFieldStates={setFieldStates} />
            </div>
        ))}
        <Textarea autoResize label="Note" placeholder="Optional" className="w-full" onChange={e => setData('note', e.target.value)} error={errors.note} />
    </div>
    )
}
