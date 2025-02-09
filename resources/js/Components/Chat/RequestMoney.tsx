import { RouteName } from "@/types";
import { ChatData, MoneyRequestData, WalletData } from "@/types/_generated";
import { useForm, usePage } from "@inertiajs/react";
import { Button } from "primereact/button";
import { Dialog } from "primereact/dialog";
import { InputNumber } from "primereact/inputnumber";
import { FormEvent } from "react";
import toast from "react-hot-toast";

export default function RequestMoney({ chat }: { chat: ChatData }) {
    const { balance, refreshBalance } = useBalance(chat.from);

    const { post, processing, errors, data, setData } = useForm<Partial<MoneyRequestData & { chat_id: number }>>({
        amount: 0,
        note: "",
        currency: "bdt",
        receiver_id: chat.from?.id,
        chat_id: chat.id,
    })
    const submit = (e?: FormEvent) => {
        e?.preventDefault()
        if (processing) return
        if(!data.amount){
            toast.error("Please enter an amount")
            return
        }
        const toastId = toast.loading("Sending money request...")
        post(route('money.request' as RouteName), {
            preserveState: false,
            onSuccess: (data) => {
                const error = data.props.error
                console.log(data)
                if (error) {
                    toast.error(error, {
                        id: toastId,
                    })
                    return
                }
                toast.success("Money request sent successfully!", {
                    id: toastId,
                })
            },
            onError: (error) => {
                console.error("Error sending money request", error)
                toast.error("Error sending money request!", {
                    id: toastId,
                })
            }
        })
    }
    useEffect(() => {
        refreshBalance()
    })
    return (
        <>
            <form className="flex flex-col !gap-2" onSubmit={submit}>
                <p className="!font-bold">User Name: {chat.from?.name}</p>
                <p className="!font-bold">User UID: #{chat.from?.id}</p>
                <p className="!font-bold">Balance: {balance} BDT</p>

                <div className="flex flex-col">
                    <InputLabel htmlFor="amount" className="!font-medium">Amount</InputLabel>
                    <InputNumber required id="amount" onChange={e => setData('amount', e.value ?? undefined)} value={data.amount ? data.amount : null} max={balance} min={1} invalid={errors.amount != null} placeholder="Amount" />
                    {Object.entries(errors).map(([key, value]) => {
                        return <InputError key={key} message={value} />
                    })}
                </div>
                <div className="!rounded-md mt-2">
                    <Button size="small" label={processing ? "Processing..." : "Send Request"} />
                </div>
            </form>
        </>
    );
}
