import { RouteName } from "@/types";
import { ChatData, MoneyRequestData, WalletData } from "@/types/_generated";
import { useForm, usePage } from "@inertiajs/react";
import { Button } from "primereact/button";
import { Dialog } from "primereact/dialog";
import { InputNumber } from "primereact/inputnumber";
import { FormEvent } from "react";
import toast from "react-hot-toast";

export default function RequestMoney({ chat }: { chat: ChatData }) {
    const { success, error } = usePage().props;
    const [visible, setVisible] = useState(false);
    const { balance, refreshBalance } = useBalance(chat.from);
    const formRef = useRef<HTMLFormElement>(null);

    const { post, processing, errors, data, setData } = useForm<Partial<MoneyRequestData & { chat_id: number }>>({
        amount: 0,
        note: "",
        currency: "bdt",
        receiver_id: chat.from?.id,
        chat_id: chat.id,
    })
    const submit = (e?: FormEvent) => {
        e?.preventDefault()
        const toastId = toast.loading("Sending money request...")
        post(route('money.request' as RouteName), {
            onSuccess: (data) => {
                if (data.props.error) {
                    toast.error(data.props.error, {
                        id: toastId,
                    })
                    return
                }
                setVisible(false)
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
    return (
        <>
            <Button rounded className="!rounded-lg" title="Request Money" onClick={() => setVisible(true)}>
                <HugeiconsMoneyReceiveCircle className="h-6 w-6" />
            </Button>
            <Dialog header="Request Money" onShow={() => refreshBalance()} footer={() => {
                return <div className="*:!rounded-md flex md:flex-row-reverse mt-3 justify-end gap-3">
                    <Button outlined label="Cancel" onClick={() => setVisible(false)} />
                    <Button label={processing ? "Processing..." : "Send Request"} onClick={e => {
                        formRef.current?.requestSubmit()
                    }} />
                </div>
            }} visible={visible} onHide={() => setVisible(false)}>
                <form className="flex flex-col gap-3" ref={formRef} onSubmit={submit}>
                    <p className="!font-bold">User Name: {chat.from?.name}</p>
                    <p className="!font-bold">User UID: #{chat.from?.id}</p>
                    <p className="!font-bold">Balance: {balance}</p>

                    <div className="flex flex-col">
                        <InputLabel htmlFor="amount" className="!font-medium">Amount</InputLabel>
                        <InputNumber id="amount" onChange={e => setData('amount', e.value ?? undefined)} value={data.amount ? data.amount : null} max={balance} min={1} invalid={errors.amount != null} placeholder="Amount" />
                        {Object.entries(errors).map(([key, value]) => {
                            return <InputError key={key} message={value} />
                        })}
                    </div>
                </form>
            </Dialog>
        </>
    );
}
