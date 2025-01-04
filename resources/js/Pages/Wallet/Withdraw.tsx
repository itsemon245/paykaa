import useBreakpoint from "@/Hooks/useBrakpoints";
import { AdditionalFields, FieldsData, WalletData, WithdrawMethodData } from "@/types/_generated";
import { cn } from "@/utils";
import { useForm, usePage } from "@inertiajs/react";
import { Button } from "primereact/button";
import { Calendar } from "primereact/calendar";
import { Card } from "primereact/card";
import { Dialog } from "primereact/dialog";
import { InputNumber, InputNumberProps } from "primereact/inputnumber";
import { InputText, InputTextProps } from "primereact/inputtext";
import { InputTextarea } from "primereact/inputtextarea";
import { ChangeEvent, HTMLAttributes } from "react";
import toast from "react-hot-toast";
import WithdrawForm from "./Partials/WithdrawForm";

interface FieldProps {
    field: FieldsData;
    fieldStates: AdditionalFields[];
    setFieldStates: (fieldStates: AdditionalFields[]) => void;
    props?: Partial<InputNumberProps & InputTextProps>;
};


export default function Withdraw() {
    const [activeWithdrawalMethod, setActiveWithdrawalMethod] = useState<WithdrawMethodData>();
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
        if ((data.amount || 0) > balance) {
            toast.error(`Cannot withdraw more than ${balance} BDT`)
            setError('amount', 'Cannot withdraw more than your balance')
            return
        }
        const url = route('wallet.withdraw.store')
        const toastId = toast.loading('Withdrawing...')
        setData('method', activeWithdrawalMethod?.label)
        setData('type', "debit")
        setData('transaction_type', 'withdraw')
        setData('withdraw_method_id', activeWithdrawalMethod?.id)

        post(url, {
            onSuccess: (data) => {
                if (data.props.error) {
                    toast.error(data.props.error)
                    return;
                }
                toast.success('Withdrawal Request Successful!')
                setActiveWithdrawalMethod(undefined)
                setTimeout(() => {
                    toast.success(<div className="text-center">You will receive the money shortly after the request is approved</div>, {
                        duration: 5000
                    })
                }, 1000)
            },
            onError: (err) => {
                console.error('Error while withdrawing', err)
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
    return (
        <>
            <Head title="Withdraw" />
            <div className="container">
                <Dialog header={`Withdraw using ${activeWithdrawalMethod?.label}`} footer={<Footer />} visible={dialogOpened} className="w-[95%] sm:w-[70vw] md:w-[50vw] !max-h-[80vh]" onHide={() => setActiveWithdrawalMethod(undefined)}>
                    <form onSubmit={e => {
                        e.preventDefault()
                        withdraw(e)
                    }}>
                        <WithdrawForm errors={errors} data={data} setData={setData} activeWithdrawalMethod={activeWithdrawalMethod} />
                    </form>
                </Dialog>
                <div className="flex flex-col gap-6 w-full my-6 px-2">
                    {mappedWithdrawMethods.map((item) => (
                        <div className="" key={`method-${item.category}`}>
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
