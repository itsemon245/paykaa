import { Button } from "@/components/ui/button";
import { useMessageStore } from "@/stores/useMessageStore";
import { RouteName } from "@/types";
import { ChatData, MoneyRequestData } from "@/types/_generated";
import { useForm } from "@inertiajs/react";
import { InputNumber } from "primereact/inputnumber";
import { FormEvent } from "react";
import toast from "react-hot-toast";

export default function RequestMoney({ chat, onSuccess }: { chat: ChatData, onSuccess?: () => void }) {
    const { message, processing: moneyRequestProcessing, moneyRequest, pending } = useMoneyRequest(undefined, chat, onSuccess)
    const { balance, refreshBalance, loadingBalance } = useBalance(chat.from);
    const duration = useMessageStore(state => state.duration)
    const setDuration = useMessageStore(state => state.setDuration)
    const [formOpened, setFormOpened] = useState<boolean>(true)

    useEffect(() => {
        if (moneyRequest == undefined) return
        const done = moneyRequest.cancelled_at != null ||
            moneyRequest.rejected_at != null ||
            moneyRequest.released_at != null
        setFormOpened(!done)

    }, [moneyRequest])

    const { post, processing, errors, data, setData } = useForm<Partial<MoneyRequestData & { chat_id: number }>>({
        amount: 0,
        note: "",
        currency: "bdt",
        receiver_id: chat.from?.id,
        chat_id: chat.id,
        duration: undefined,
    })
    useEffect(() => {
        setData('duration', duration)
    }, [duration])
    const submit = (e?: FormEvent) => {
        e?.preventDefault()
        if (processing) return
        if (duration.day === 0 && duration.hour === 0 && duration.minute < 30) {
            toast.error("Minimum duration is 30 minutes")
            return
        }

        if (!data.amount) {
            toast.error("Please enter an amount")
            return
        }
        const toastId = toast.loading("Sending money request...")
        post(route('money.request' as RouteName), {
            only: ['messages', 'chats'],
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
                onSuccess?.()

            },
            onError: (error) => {
                console.error("Error sending money request", error)
                toast.error("Error sending money request!", {
                    id: toastId,
                })
            },
            onFinish: () => {
                setDuration({
                    day: 0,
                    hour: 6,
                    minute: 0
                })
                setTimeout(() => {
                    toast.dismiss(toastId)
                }, 1000)
            }
        })
    }
    useEffect(() => {
        refreshBalance()
    }, [])
    return (
        <div className="h-full relative">
            {!formOpened && <Button type="button" className="absolute top-0 right-4" onClick={e => setFormOpened(true)}>New</Button>}
            <form className="flex flex-col !gap-2" onSubmit={submit}>
                <p className="!font-bold">User Name: {chat.from?.name}</p>
                <p className="!font-bold">User UID: #{chat.from?.id}</p>
                <p className="!font-bold">Balance: {loadingBalance ? 'Loading...' : balance + ' BDT'}</p>
                {chat.from?.phone ? <p className="!font-bold">Contact: {chat.from?.phone}</p> : <p className="!font-bold flex items-center gap-2">Contact: <span className="text-muted text-normal">No contact info</span></p>}

                {
                    moneyRequestProcessing ?
                        <div className="flex items-center justify-center gap-2 mt-2">
                            <span className="pi pi-spin pi-spinner"></span> Processing...
                        </div> :
                        <>
                            <div>
                                {
                                    message && message.type === 'money_request' && !formOpened ?
                                        <MoneyRequestActions moneyRequest={moneyRequest} chat={chat} onSuccess={onSuccess} />
                                        :
                                        <>
                                            <div className="flex flex-col mb-2">
                                                <InputLabel htmlFor="amount" className="!font-medium text-lg">Amount</InputLabel>
                                                <InputNumber disabled={moneyRequest !== undefined} required id="amount" onChange={e => setData('amount', e.value ?? undefined)} value={data.amount ? data.amount : null} max={balance} min={1} invalid={errors.amount != null} placeholder="Amount" />
                                                {Object.entries(errors).map(([key, value]) => {
                                                    return <InputError key={key} message={value} />
                                                })}
                                            </div>
                                            <div className="my-2">
                                                <label className="text-gray-800 text-md font-bold">Time Limit:</label>
                                                <TimeSelector />
                                            </div>
                                            <Button loading={processing}>Send Request</Button>
                                        </>
                                }
                            </div>
                        </>
                }
            </form>
            {
                moneyRequest
                && pending
                && moneyRequest.expires_at != null
                && <div className="mt-4">
                    <ReportMoneyRequest moneyRequest={moneyRequest} />
                </div>
            }
        </div>
    );
}
