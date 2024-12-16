import { WalletData } from "@/types/_generated"
import { SetData } from "@inertiajs/react"
import { InputNumber, InputNumberChangeEvent } from "primereact/inputnumber"

interface ManualMobileBankingProps {
    data: Partial<WalletData>,
    setData: SetData<WalletData>,
    errors: Partial<Record<keyof WalletData, string>>
}

export default function ManualMobileBanking({
    data,
    setData,
    errors,
}: ManualMobileBankingProps) {

    const onAmountChange = (e: InputNumberChangeEvent) => {
        const amount = e.value
        if (amount) {
            setData('amount', amount)
        } else {
            setData('amount', 0)
        }
    }
    useEffect(() => {
        console.log(data)
    }, [JSON.stringify(data)])

    return (
        <div className="flex flex-col gap-3 w-full">
            <div>
                <InputLabel value="Amount" />
                <InputNumber value={data.amount} onChange={onAmountChange} autoFocus={true} placeholder="Enter Amount" className="w-full h-20 *:text-center text-center" />
                {errors.amount && <InputError message={errors.amount} />}
            </div>
            <Input onChange={e => setData('payment_number', e.target.value)} error={errors.payment_number} label="Mobile Number" placeholder="Enter Mobile Number" className="w-full" />
            <Input label="Transaction ID" placeholder="Enter Transaction ID from the message" error={errors.transaction_id} className="w-full" onChange={e => setData('transaction_id', e.target.value)} />
            <Textarea autoResize label="Note(optional)" placeholder="Enter a note" className="w-full" onChange={e => setData('note', e.target.value)} error={errors.note} />
        </div>
    )
}
