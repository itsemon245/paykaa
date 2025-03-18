import { useMessageStore } from "@/stores/useMessageStore";
import { RouteName } from "@/types";
import { ChatData, MoneyRequestData, WalletData } from "@/types/_generated";
import { cn } from "@/utils";
import { useForm, usePage } from "@inertiajs/react";
import { add, format } from "date-fns";
import { Button } from "primereact/button";
import { Dialog } from "primereact/dialog";
import { InputNumber } from "primereact/inputnumber";
import { FormEvent } from "react";
import toast from "react-hot-toast";

export default function RequestMoney({ chat, onSuccess }: { chat: ChatData, onSuccess?: () => void }) {
    const { accept, release, requestRelease, message, cancel, processing: moneyRequestProcessing, reject, moneyRequest } = useMoneyRequest(undefined, chat, onSuccess)
    const { balance, refreshBalance, loadingBalance } = useBalance(chat.from);
    const duration = useMessageStore(state => state.duration)
    const setDuration = useMessageStore(state => state.setDuration)

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
        if (duration.day === 0 && duration.hour < 6) {
            toast.error("Minimum duration is 6 hours")
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
    const getSeverity = (moneyRequest: MoneyRequestData) => {
        if (!message) return
        if (moneyRequest.cancelled_at) {
            return "danger"
        }
        if (moneyRequest.status === 'completed') {
            return "success"
        }
        if (moneyRequest.status === 'waiting for release') {
            return "warning"
        }
        if (moneyRequest.rejected_at) {
            return "danger"
        }
        if (moneyRequest.accepted_at) {
            return undefined
        }
        return "warning"
    }

    const getStatus = (moneyRequest: MoneyRequestData) => {
        if (!message) return
        if (moneyRequest.status === 'approved') {
            return message.by_me ? "Request Release" : "Request Accepted"
        }
        if (moneyRequest.status === 'waiting for release') {
            return !message.by_me ? "Please Release" : "Waiting for Release"
        }
        return moneyRequest.status
    }


    const UserButtons = ({ moneyRequest }: { moneyRequest: MoneyRequestData }) => {
        if (!message) return
        if (moneyRequest.status !== 'pending') {
            return <Button
                type="button"
                onClick={e => {
                    if (moneyRequest.status === 'waiting for release' && !message.by_me) {
                        release();
                        return;
                    }

                }} rounded severity={getSeverity(moneyRequest as MoneyRequestData)} className={cn("capitalize !rounded-lg w-full justify-center *:!font-bold *:!w-max", moneyRequest.status === 'approved' && '!text-black !bg-[#D8BBFF] !border-[#D8BBFF]')} label={processing ? 'Proccessing...' : getStatus(moneyRequest as MoneyRequestData)} />
        }
        return (
            <div className="grid grid-cols-2 items-center gap-3">
                <Button
                    type="button"

                    onClick={accept} rounded severity="success" className="capitalize !rounded-lg justify-center *:!font-bold" label={processing ? 'Processing...' : 'Accept'} icon="pi pi-check" />
                <Button
                    type="button"
                    onClick={reject} rounded severity="danger" className="capitalize !rounded-lg justify-center *:!font-bold" label={processing ? 'Processing...' : 'Reject'} icon="pi pi-times" />
            </div>
        )
    }

    const MyButtons = ({ moneyRequest }: { moneyRequest: MoneyRequestData }) => {
        return (<div className=" flex items-center gap-2">
            <Button
                type="button"
                onClick={e => {
                    if (moneyRequest.status === 'approved') {
                        requestRelease();
                    }
                }} rounded severity={getSeverity(moneyRequest as MoneyRequestData)} className={cn("!rounded-lg w-full justify-center capitalize *:!font-bold *:!w-max", moneyRequest.status === 'approved' && '!text-black !bg-[#D8BBFF] !border-[#D8BBFF]')} label={processing ? 'Proccessing...' : getStatus(moneyRequest as MoneyRequestData)} />
            {!moneyRequest?.cancelled_at && !moneyRequest.accepted_at && !moneyRequest.rejected_at && <Button
                type="button"
                onClick={cancel} rounded severity="danger" className="!rounded-lg w-full justify-center *:!font-bold *:!w-max capitalize" label={processing ? 'Proccessing...' : 'Cancel'} />}
        </div>
        )
    }

    useEffect(() => {
        refreshBalance()
    }, [])
    return (
        <>
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
                                    message && message.type === 'money_request' ?
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
                                            <Button size="small" label={processing ? "Processing..." : "Send Request"} />
                                        </>
                                }
                            </div>
                        </>
                }
            </form>
        </>
    );
}
