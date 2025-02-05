import { RouteName } from "@/types";
import { ChatData, MessageData, MoneyRequestData } from "@/types/_generated";
import { cn } from "@/utils";
import { router, usePage } from "@inertiajs/react";
import { format, parseISO } from "date-fns";
import { Button } from "primereact/button";
import { Card } from "primereact/card";
import { Tag } from "primereact/tag";
import toast from "react-hot-toast";

export default function MoneyRequestMessage({ message, chat }: { message: MessageData, chat: ChatData }) {

    const getSeverity = (moneyRequest: MoneyRequestData) => {
        if (moneyRequest.cancelled_at) {
            return "danger"
        }
        if (moneyRequest.status === 'completed') {
            return "success"
        }
        if (moneyRequest.status === 'waiting for release') {
            return !message.by_me ? undefined : "warning"
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
        if (moneyRequest.status === 'approved') {
            return message.by_me ? "Request release" : "Accepted"
        }
        if (moneyRequest.status === 'waiting for release') {
            return !message.by_me ? "Release" : "Waiting for Release"
        }
        return moneyRequest.status
    }

    const UserButtons = ({ moneyRequest }: { moneyRequest: MoneyRequestData }) => {
        const [processing, setProcessing] = useState(false);
        const accept = async () => {
            setProcessing(true)
            const toastId = toast.loading("Accepting money request...")
            router.post(route('money.accept' as RouteName, {
                moneyRequest: message.moneyRequest?.uuid,
            }), {}, {
                onSuccess: () => {
                    setProcessing(false)
                    toast.success("Requested accept!")
                    toast.dismiss(toastId)
                },
                onError: () => {
                    setProcessing(false)
                    toast.error("Failed to accept request")
                    console.error("Error accept request")
                    toast.dismiss(toastId)
                },
                preserveState: false,
                preserveScroll: true
            })
        }
        const release = async () => {
            setProcessing(true)
            const toastId = toast.loading("Releasing money request...")
            router.post(route('money.release' as RouteName, {
                moneyRequest: message.moneyRequest?.uuid,
            }), {}, {
                onSuccess: () => {
                    setProcessing(false)
                    toast.success("Requested released!")
                    toast.dismiss(toastId)
                },
                onError: () => {
                    setProcessing(false)
                    toast.error("Failed to release request")
                    console.error("Error release request")
                    toast.dismiss(toastId)
                },
                preserveState: false,
                preserveScroll: true
            })
        }
        const reject = async () => {
            setProcessing(true)
            const toastId = toast.loading("Rejecting money request...")
            router.post(route('money.reject' as RouteName, {
                moneyRequest: message.moneyRequest?.uuid,
            }), {}, {
                onSuccess: () => {
                    setProcessing(false)
                    toast.success("Requested rejected!")
                    toast.dismiss(toastId)
                },
                onError: () => {
                    setProcessing(false)
                    toast.error("Failed to reject request")
                    console.error("Error rejecting request")
                    toast.dismiss(toastId)
                },
                preserveState: false,
                preserveScroll: true
            })
        }
        if (moneyRequest.status !== 'pending') {
            return <Button onClick={e => {
                if (moneyRequest.status === 'waiting for release' && !message.by_me) {
                    release();
                    return;
                }

            }} rounded severity={getSeverity(moneyRequest as MoneyRequestData)} className="!rounded-lg w-full justify-center *:!font-bold *:!w-max" label={processing ? 'Proccessing...' : getStatus(moneyRequest as MoneyRequestData)} />
        }
        return (
            <div className="grid grid-cols-2 items-center gap-3">
                <Button onClick={accept} rounded severity="success" className="!rounded-lg justify-center *:!font-bold" label={processing ? 'Processing...' : 'Accept'} icon="pi pi-check" />
                <Button onClick={reject} rounded severity="danger" className="!rounded-lg justify-center *:!font-bold" label={processing ? 'Processing...' : 'Reject'} icon="pi pi-times" />
            </div>
        )
    }

    const MyButtons = ({ moneyRequest }: { moneyRequest: MoneyRequestData }) => {
        const [processing, setProcessing] = useState(false);
        const cancel = async () => {
            setProcessing(true)
            const toastId = toast.loading("Cancelling money request...")
            router.post(route('money.cancel' as RouteName, {
                moneyRequest: message.moneyRequest?.uuid,
            }), {}, {
                onSuccess: () => {
                    setProcessing(false)
                    toast.success("Cancelled request!")
                    toast.dismiss(toastId)
                },
                onError: () => {
                    setProcessing(false)
                    toast.error("Failed to cancel request")
                    console.error("Error cancel request")
                    toast.dismiss(toastId)
                },
                preserveState: false,
                preserveScroll: true
            })
        }

        const requestRelease = async () => {
            setProcessing(true)
            const toastId = toast.loading("Requesting release...")
            router.post(route('money.request-release' as RouteName, {
                moneyRequest: message.moneyRequest?.uuid,
            }), {}, {
                onSuccess: () => {
                    setProcessing(false)
                    toast.success("Requested release")
                    toast.dismiss(toastId)
                },
                onError: () => {
                    setProcessing(false)
                    toast.error("Failed to request release")
                    console.error("Error release request")
                    toast.dismiss(toastId)
                },
                preserveState: false,
                preserveScroll: true
            })
        }
        return (<div className=" flex items-center gap-2">
            <Button onClick={e => {
                if (moneyRequest.status === 'approved') {
                    requestRelease();
                }
            }} rounded severity={getSeverity(moneyRequest as MoneyRequestData)} className="!rounded-lg w-full justify-center *:!font-bold *:!w-max" label={processing ? 'Proccessing...' : getStatus(moneyRequest as MoneyRequestData)} />
            {!moneyRequest?.cancelled_at && !moneyRequest.accepted_at && <Button onClick={cancel} rounded severity="danger" className="!rounded-lg w-full justify-center *:!font-bold *:!w-max" label={processing ? 'Proccessing...' : 'Cancel'} />
            }
        </div>
        )
    }

    return (
        <div className={cn("message", message.by_me ? "me" : "")}>
            {!message.by_me && (
                <img
                    className="avatar-md"
                    src={chat.from?.avatar}
                    data-toggle="tooltip"
                    data-placement="top"
                    title={chat.from?.name}
                    alt="avatar"
                />
            )}

            <div>
                <Card pt={{
                    content: {
                        className: "py-2",
                    }
                }}>
                    <div className="text-center text-xs font-medium">Money Request</div>
                    <div className="text-center md:text-lg font-bold my-1.5 text-green-600">{message.moneyRequest?.amount.toFixed(2)} BDT</div>
                    <div className="text-sm font-medium mb-2 flex items-center gap-2">{message.by_me ? "You have " : `${message.moneyRequest?.from?.name} has `} requested Money
                    </div>
                    {message.by_me ?
                        <MyButtons moneyRequest={message.moneyRequest as MoneyRequestData} />
                        : <UserButtons moneyRequest={message.moneyRequest as MoneyRequestData} />

                    }
                </Card>
                <span className="mt-1">{format(parseISO(message.created_at as string), 'hh:mm a')}</span>
            </div>
        </div>
    )
}

