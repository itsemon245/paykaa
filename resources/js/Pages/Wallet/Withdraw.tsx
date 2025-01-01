import useBreakpoint from "@/Hooks/useBrakpoints";
import { AdditionalFields, FieldsData, WalletData, WithdrawMethodData } from "@/types/_generated";
import { cn } from "@/utils";
import { useForm, usePage } from "@inertiajs/react";
import { Button } from "primereact/button";
import { Card } from "primereact/card";
import { Dialog } from "primereact/dialog";
import { InputNumber, InputNumberProps } from "primereact/inputnumber";
import { InputText, InputTextProps } from "primereact/inputtext";
import { HTMLAttributes } from "react";
import toast from "react-hot-toast";

interface FieldProps {
    field: FieldsData;
    fieldStates: AdditionalFields[];
    setFieldStates: (fieldStates: AdditionalFields[]) => void;
    props?: Partial<InputNumberProps & InputTextProps>;
};

function FieldInput({ field, fieldStates, setFieldStates, ...props }: FieldProps) {
    const handleChange = (e: any) => {
        const value = e.target.value;
        setFieldStates([
            ...fieldStates,
            {
                name: field.name,
                value: value
            }
        ])
    }
    switch (field.type) {
        case "text":
            return <InputText onChange={handleChange} type="text" placeholder={field.placeholder} required={field.required} className="w-full" {...props} />
        case "number":
            return <InputNumber onChange={handleChange} placeholder={field.placeholder} required={field.required} className="w-full" {...props} />
        default:
            return <InputText onChange={handleChange} type={field.type} placeholder={field.placeholder} required={field.required} className="w-full" {...props} />
    }

}

export default function Withdraw() {
    const [activeWithdrawalMethod, setActiveWithdrawalMethod] = useState<WithdrawMethodData>();
    const [fieldStates, setFieldStates] = useState<AdditionalFields[]>([]);
    const dialogOpened = useMemo(() => activeWithdrawalMethod !== undefined, [activeWithdrawalMethod]);
    const balance = usePage().props.balance as number
    const { min } = useBreakpoint()
    const withdrawMethods = usePage().props.withdrawMethods as WithdrawMethodData[]
    const { data, setData, setError, post, errors, processing } = useForm<Partial<WalletData>>({
        amount: 0,
        payment_number: "",
        note: "",
        type: "debit",
        transaction_type: "withdraw",
        method: "",
        currency: "bdt",
        additional_fields: []
    });

    const withdraw = async (e: React.FormEvent<HTMLFormElement> | React.MouseEvent<HTMLButtonElement>) => {
        setData('additional_fields', fieldStates)
        if (data.amount ?? 0 > balance) {
            toast.error(`Cannot withdraw more than ${balance} BDT`)
            return
        }
        const url = route('wallet.withdraw.store')
        const toastId = toast.loading('Withdrawing...')
        post(url, {
            onSuccess: (data) => {
                toast.success('Withdrawal Request Successful!')
                setActiveWithdrawalMethod(undefined)
                setTimeout(() => {
                    toast.success(<div className="text-center">You will receive the money shortly after the request is approved</div>, {
                        duration: 5000
                    })
                }, 1000)
            },
            onError: (err) => {
                toast.error('Withdrawal Failed!')
            },
            onFinish: () => {
                toast.dismiss(toastId)
            }
        })
    }

    const mappedWithdrawMethods = withdrawMethods.reduce((acc, method) => {
        const existing = acc.find(item => item.category === method.category);
        if (existing) {
            existing.methods.push(method);
        } else {
            acc.push({
                category: method.category,
                methods: [method]
            })
        }
        return acc;
    }, [] as { category: string, methods: WithdrawMethodData[] }[])

    const Footer = () => {
        return (
            <div className="flex justify-end md:flex-row-reverse gap-2">
                <Button outlined label="Cancel" onClick={() => setActiveWithdrawalMethod(undefined)} />
                <Button label="Withdraw" onClick={withdraw} loading={processing} />
            </div>
        )
    }
    useEffect(() => {
        if (activeWithdrawalMethod) {
            setData('method', activeWithdrawalMethod?.label)
        }
    }, [activeWithdrawalMethod])
    return (
        <>
            <Head title="Withdraw" />
            <div className="container">
                <Dialog header={`Withdraw using ${activeWithdrawalMethod?.label}`} footer={<Footer />} visible={dialogOpened} className="w-[95%] sm:w-[70vw] md:w-[50vw]" onHide={() => setActiveWithdrawalMethod(undefined)}>
                    <form onSubmit={e => {
                        e.preventDefault()
                        withdraw(e)
                    }}>
                        <div className="flex flex-col justify-center items-center w-full my-2 gap-3 *:w-full">
                            <div>
                                <InputLabel value="Amount to withdraw" />
                                <InputNumber value={data.amount ? data.amount : null} onChange={e => setData('amount', e.value as number)} autoFocus={true} placeholder="Enter Your withdraw amount" className="w-full" />
                            </div>
                            <Input onChange={e => setData('payment_number', e.target.value)} error={errors.payment_number}
                                label={activeWithdrawalMethod?.category === 'Cryptocurrency' ? 'Address' : 'Account Number'}
                                placeholder={activeWithdrawalMethod?.category === 'Cryptocurrency' ? '0xxd....' : 'Enter the account number'}
                                className="w-full" />
                            {activeWithdrawalMethod?.fields?.map(field => (
                                <div>
                                    <InputLabel value={field.label} />
                                    <FieldInput field={field} />
                                </div>
                            ))}
                        </div>
                    </form>
                </Dialog>
                <div className="flex flex-col gap-6 w-full my-6 px-2">
                    {mappedWithdrawMethods.map((item) => (
                        <div className="">
                            <h1 className="md:text-xl font-bold mb-3 text-gray-800">{item.category}</h1>
                            <div className="flex max-sm:flex-col items-center flex-wrap gap-2 sm:gap-3 w-full">
                                {item.methods.map((method, index) => {
                                    return (
                                        <Card className={cn("border transition-all cursor-pointer max-sm:w-full", min("md") && 'hover:scale-105')} key={index} onClick={e => setActiveWithdrawalMethod(method)} role="button">
                                            <div className="flex w-full gap-5 items-center justify-start">
                                                <img src={`/storage/${method.logo}`} className="h-12 w-auto sm:w-32" alt={method.label} />
                                                <div className="text-center text-sm sm:text-base font-bold sm:hidden">
                                                    {method.label}
                                                </div>
                                            </div>
                                        </Card>
                                    )
                                })}
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </>
    )
}
