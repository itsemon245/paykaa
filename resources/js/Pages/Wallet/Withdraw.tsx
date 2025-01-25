import useBreakpoint from "@/Hooks/useBrakpoints";
import { Message } from 'primereact/message';
import { AdditionalFields, FieldsData, WalletData, WithdrawMethodData } from "@/types/_generated";
import { cn, image } from "@/utils";
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


export default function Withdraw({ canWithdraw }: { canWithdraw: boolean }) {
    const [activeWithdrawalMethod, setActiveWithdrawalMethod] = useState<WithdrawMethodData>();
    const dialogOpened = useMemo(() => activeWithdrawalMethod !== undefined, [activeWithdrawalMethod]);
    const { balance, refreshBalance } = useBalance()
    const { min } = useBreakpoint()
    const withdrawMethods = usePage().props.withdrawMethods as WithdrawMethodData[]
    const { data, setData, setError, post, errors, processing, clearErrors } = useForm<Partial<WalletData>>({
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
        refreshBalance()
        if ((data.amount || 0) > balance) {
            toast.error(`Cannot withdraw more than ${balance} BDT`)
            setError('amount', `Cannot withdraw more than ${balance} BDT`)
            return
        }
        const url = route('wallet.withdraw.store')
        const toastId = toast.loading('Withdrawing...')

        //Using setTimeout because the data is not being updated immediately
        setTimeout(() => {
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
        }, 1000);

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

    const Methods = ({ item }: { item?: { category: string, methods: WithdrawMethodData[] } }) => {
        if (!item) {
            return null
        }
        return (
            <div className="" key={item.category}>
                <h1 className="md:text-xl font-bold mb-3 text-gray-800">{item.category === 'Mobile Banking' ? 'E-Payments' : item.category}</h1>
                <div className="flex justify-start items-center flex-wrap gap-2 sm:gap-3 w-full">
                    {item.methods.map((method, index) => {
                        return (
                            <Card className={cn("border transition-all cursor-pointer max-sm:w-full", min("md") && 'hover:scale-105')} key={index} onClick={e => setActiveWithdrawalMethod(method)} role="button">
                                <div className="flex w-full gap-5 items-center justify-start">
                                    <img src={`/storage/${method.logo}`} className="w-[100px] h-[56px] object-contain" alt={method.label} />
                                    <div className="text-center text-sm sm:text-base font-bold sm:hidden">
                                        {method.label}
                                    </div>
                                </div>
                            </Card>
                        )
                    })}
                </div>
            </div>
        )
    }


    useEffect(() => {
        if (activeWithdrawalMethod) {
            setData('method', activeWithdrawalMethod?.category)
            setData('type', "debit")
            setData('transaction_type', "withdraw")
            setData('withdraw_method_id', activeWithdrawalMethod?.id)
        } else {
            clearErrors()
        }
    }, [activeWithdrawalMethod])

    const withdrawForm = useRef<HTMLFormElement>(null)
    const Footer = () => {
        return (
            <div className="flex justify-end md:flex-row-reverse gap-2">
                <Button outlined label="Cancel" onClick={() => setActiveWithdrawalMethod(undefined)} />
                <Button label="Withdraw" className="disabled:cursor-not-allowed" onClick={(e) => withdrawForm.current?.requestSubmit()} disabled={!canWithdraw || processing} loading={processing} />
            </div>
        )
    }
    return (
        <>
            <Head title="Withdraw" />
            <div className="container">
                <Dialog header={`Withdraw using ${activeWithdrawalMethod?.category === 'Bank' ? 'Bank' : activeWithdrawalMethod?.label}`} footer={<Footer />} visible={dialogOpened} className="w-[95%] sm:w-[70vw] md:w-[50vw] !max-h-[80vh]" onHide={() => setActiveWithdrawalMethod(undefined)}>
                    <form onSubmit={e => {
                        e.preventDefault()
                        withdraw(e)
                    }} ref={withdrawForm}>
                        <div className="flex flex-col justify-center items-center w-full my-2 gap-3">
                            {canWithdraw ? <>

                                <img src={image(activeWithdrawalMethod?.logo)} className="w-28 md:w-36  p-3 border rounded-lg" />
                                <h3 className="text-center font-bold text-xl mb-1 -mt-3">{activeWithdrawalMethod?.label}</h3>
                                <div className="text-xs md:text-sm font-medium text-center mb-2">Fill the form below with correct details to receive your money</div>
                            </> :
                                <Message severity="warn" className="max-w-[600px] text-center" text="You already have a withdrawal pending. Please wait for it to be approved to request another withdrawal." />
                            }

                        </div>
                        <WithdrawForm errors={errors} data={data} setData={setData} activeWithdrawalMethod={activeWithdrawalMethod} />
                    </form>
                </Dialog>
                <div className="grid md:grid-cols-3 md:gap-10 w-full my-6 px-2">
                    <Methods item={mappedWithdrawMethods.find(item => item.category === 'Mobile Banking')} />
                    <Methods item={mappedWithdrawMethods.find(item => item.category === 'Bank')} />
                    <Methods item={mappedWithdrawMethods.find(item => item.category === 'Cryptocurrency')} />
                </div>
            </div>
        </>
    )
}
