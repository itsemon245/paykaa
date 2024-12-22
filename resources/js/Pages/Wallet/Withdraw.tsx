import { WalletData } from "@/types/_generated";
import { useForm, usePage } from "@inertiajs/react";
import { Button } from "primereact/button";
import { Card } from "primereact/card";
import { Dialog } from "primereact/dialog";
import { InputNumber } from "primereact/inputnumber";
import toast from "react-hot-toast";

export default function Withdraw() {
    const [activeWithdrawalMethod, setActiveWithdrawalMethod] = useState<{ name: string, logo: string, label: string }>();
    const dialogOpened = useMemo(() => activeWithdrawalMethod !== undefined, [activeWithdrawalMethod]);
    const balance = usePage().props.balance as number
    const widrawalMethods = [
        {
            name: "bkash",
            logo: "/assets/logos/bkash.svg",
            label: "Bkash",
        },
    ]
    const { data, setData, setError, post, errors, processing } = useForm<Partial<WalletData>>({
        amount: 0,
        payment_number: "",
        note: "",
        type: "debit",
        transaction_type: "withdraw",
        method: "",
        currency: "bdt",
    });
    const withdraw = async (e: React.FormEvent<HTMLFormElement> | React.MouseEvent<HTMLButtonElement>) => {
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

    const Footer = () => {
        return (
            <div className="flex justify-end md:flex-row-reverse gap-2">
                <Button outlined label="Cancel" onClick={() => setActiveWithdrawalMethod(undefined)} />
                <Button label="Deposit" onClick={withdraw} loading={processing} />
            </div>
        )
    }
    useEffect(() => {
        if (activeWithdrawalMethod) {
            setData('method', activeWithdrawalMethod?.name)
        }
    }, [activeWithdrawalMethod])
    return (
        <>
            <Head title="Withdraw" />
            <div className="container mx-auto my-6">
                <Card>
                    <h1 className="text-xl font-bold mb-3">Choose your withdrawal method</h1>
                    <div className="flex items-center flex-wrap gap-3 ">
                        {widrawalMethods.map((method, index) => {
                            return (
                                <Card key={index} onClick={e => setActiveWithdrawalMethod(method)} role="button" className="border hover:scale-105 transition-all cursor-pointer flex flex-col w-max gap-1 items-center justify-center">
                                    <div>
                                        {typeof method.logo === "string" ? <img src={method.logo} className="w-32" /> : method.logo}
                                    </div>
                                </Card>
                            )
                        })}
                    </div>
                    <Dialog header={`Withdraw using ${activeWithdrawalMethod?.label}`} footer={<Footer />} visible={dialogOpened} className="w-[95%] sm:w-[70vw] md:w-[50vw]" onHide={() => setActiveWithdrawalMethod(undefined)}>
                        <form onSubmit={e => {
                            e.preventDefault()
                            withdraw(e)
                        }}>
                            <div className="flex flex-col justify-center items-center w-full my-4 gap-2">
                                <img src={activeWithdrawalMethod?.logo} className="w-40 p-3 border rounded-lg" />
                            </div>
                            <div className="flex flex-col gap-3 w-full">
                                <div>
                                    <InputLabel value="Amount to withdraw" />
                                    <InputNumber value={data.amount} onChange={e => setData('amount', e.value as number)} autoFocus={true} placeholder="Enter Your withdraw amount" className="w-full h-20 *:text-center text-center" />
                                    {errors.amount && <InputError message={errors.amount} />}
                                </div>
                                <Input onChange={e => setData('payment_number', e.target.value)} error={errors.payment_number} label="Mobile Number" placeholder="Enter the mobile number (personal)" className="w-full" />
                                <Textarea autoResize label="Note(optional)" placeholder="Enter a note (optional)" className="w-full" onChange={e => setData('note', e.target.value)} error={errors.note} />
                            </div>
                        </form>

                    </Dialog>


                </Card>
            </div>
        </>
    )
}
