import { DepositMethodData, WalletData } from "@/types/_generated"
import { transform } from "@/utils"
import { SetData, usePage } from "@inertiajs/react"
import { parseInt } from "lodash"
import { InputNumber, InputNumberChangeEvent } from "primereact/inputnumber"

interface ManualMobileBankingProps {
    data: Partial<WalletData>,
    setData: SetData<WalletData>,
    errors: Partial<Record<keyof WalletData, string>>
    depositMethod?: DepositMethodData
    setUploading: (uploading: boolean) => void
}

export default function ManualMobileBanking({
    data,
    setData,
    errors,
    depositMethod,
    setUploading
}: ManualMobileBankingProps) {
    const { app } = useConfig()
    const { base_commission } = usePage().props.settings.transactions
    const charge = useMemo(() => {
        console.log("charge", base_commission, depositMethod?.charge)
        return (depositMethod?.charge ?? 0) + parseInt(base_commission)
    }, [depositMethod])


    const total = useMemo(() => {
        if (!data.amount) return 0;
        let commission = Math.round(data.amount * (charge / 100))
        setData('commission', commission)
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
    const getNumberLabel = useMemo(() => {
        if (depositMethod?.category === "Mobile Banking") {
            return "Number";
        }
        if (depositMethod?.category === "Bank") {
            return "A/c Number"
        }
        return "Wallet Address"
    }, [depositMethod])

    return (
        <div className="flex flex-col gap-3 w-full">
            {total > 0 && (
                <div className="mb-2">
                    {
                        data.amount === 0 ?
                            <div className="text-sm text-gray-500 text-start">We charge a <span className="font-bold">{charge} %</span> service charge on top of each deposits.</div>
                            :
                            <>
                                <InputLabel value="Full Amount" />
                                <div className="flex items-center justify-center border p-1.5 rounded-lg text-lg font-bold opacity-75 cursor-not-allowed">{total + ".00"} {depositMethod?.category !== 'Cryptocurrency' && 'BDT'}</div>
                                <div className="text-sm text-gray-500 text-start">Service Charge: <span className="font-bold">{charge}%</span></div>
                            </>
                    }
                </div>
            )}
            <div>
                <InputLabel value="Deposit Amount" />
                <InputNumber required invalid={errors.amount !== undefined} value={data.amount ? data.amount : undefined} onChange={onAmountChange} autoFocus placeholder="Amount" className="w-full *:text-center text-center" />
                {errors.amount && <InputError message={errors.amount} />}
            </div>
            <Input onChange={e => setData('payment_number', e.target.value)} error={errors.payment_number} label={getNumberLabel} placeholder={getNumberLabel} className="w-full" required />
            {depositMethod?.category === "Mobile Banking" && (
                <Input required label="Transaction ID" placeholder="Transaction ID" error={errors.transaction_id} className="w-full" onChange={e => setData('transaction_id', e.target.value)} />
            )}
            {depositMethod?.category === "Bank" && (
                <Input required onChange={e => setData('account_holder', e.target.value)} error={errors.account_holder} label="A/c Name" placeholder="A/c Name" className="w-full" />
            )}

            <Textarea autoResize label="Note" placeholder="Optional" className="w-full" onChange={e => setData('note', e.target.value)} error={errors.note} />
            {depositMethod?.category === 'Bank' && (
                <Filedrop path="/temp/receipts" setUploading={setUploading} className="min-h-[120px]" label="Upload receipt (optional)" onProcessFile={(path, storageUrl) => {
                    setData('receipt', storageUrl)
                }} accept="image/*" />
            )}
        </div>
    )
}
