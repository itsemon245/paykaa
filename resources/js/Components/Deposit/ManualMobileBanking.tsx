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
    const { app } = useConfig()

    const commission = useMemo(() => {
        if (!data.amount) return 0;
        let com = app.payment.is_fixed_amount ? app.payment.charge : data.amount * (app.payment.charge / 100)
        return Math.round(com)
    }, [data.amount])

    const total = useMemo(() => {
        if (!data.amount) return 0;
        return data.amount + commission
    }, [data.amount])

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
            {total > 0 && (
                <div className="mb-2">
                    <InputLabel value="Amount to pay" />
                    <div className="flex items-center justify-center h-20 border-primary border-2 rounded-lg text-lg font-bold">{total + ".00"} BDT</div>
                    <div className="text-smtext-gray-500 text-start">We charge a <span className="font-bold">{app.payment.charge}{app.payment.is_fixed_amount ? 'BDT' : "%"}</span> service charge on top of each deposits.</div>
                </div>
            )}
            <div>
                <InputLabel value="Amount to deposit" />
                <InputNumber value={data.amount} onChange={onAmountChange} autoFocus={true} placeholder="Enter Amount" className="w-full h-20 *:text-center text-center" />
                {errors.amount && <InputError message={errors.amount} />}
            </div>
            <Input onChange={e => setData('payment_number', e.target.value)} error={errors.payment_number} label="Mobile Number" placeholder="Enter the number you sent money from" className="w-full" />
            <Input label="Transaction ID" placeholder="Enter Transaction ID from the message" error={errors.transaction_id} className="w-full" onChange={e => setData('transaction_id', e.target.value)} />
            <Textarea autoResize label="Note(optional)" placeholder="Enter a note(optional)" className="w-full" onChange={e => setData('note', e.target.value)} error={errors.note} />
        </div>
    )
}
