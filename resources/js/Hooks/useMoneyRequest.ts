import { PaginatedCollection, RouteName } from "@/types";
import { ChatData, MessageData, MoneyRequestData } from "@/types/_generated";
import { router } from "@inertiajs/react";
import toast from "react-hot-toast";
import { useState, useEffect } from "react";

export default function useMoneyRequest(moneyRequestMessage?: MessageData, chat?: ChatData, onSuccess?: () => void) {

    const [processing, setProcessing] = useState(true);
    const [message, setMessage] = useState<MessageData>();
    const [moneyRequest, setMoneyRequest] = useState<MoneyRequestData>();
    const [fetching, setFetching] = useState(false)
    const pending = useMemo(() => {
        return moneyRequest?.released_at == null
            && moneyRequest?.rejected_at == null
            && moneyRequest?.cancelled_at == null
    }, [moneyRequest])
    const fetchMessage = async () => {
        setFetching(true)
        console.log("Fetching message")
        const res = await fetch(route('messages.money-requests', { chat: moneyRequestMessage?.chat?.uuid ?? chat?.uuid }))
        if (!res.ok) {
            toast.error('Failed to fetch pending money request')
            console.log("Error fetching message", res)
            setFetching(false)
            setProcessing(false)
            return
        }
        const data = await res.json() as { messages: PaginatedCollection<MessageData> }
        if (data.messages) {
            setMessage(data.messages.data[0] ?? undefined);
            const request = data.messages.data[0]?.moneyRequest;
            setMoneyRequest(request);
            setFetching(false)
            setProcessing(false)
        }
    }
    useEffect(() => {
        if (!moneyRequestMessage) {
            fetchMessage()
        } else {
            setProcessing(false)
            setMessage(moneyRequestMessage)
            const request = moneyRequestMessage?.data ?? moneyRequestMessage?.moneyRequest
            if (request) {
                request.by_me = request?.sender_id === user?.id
                setMoneyRequest(request)
            }
        }
    }, [moneyRequestMessage])

    const { user } = useAuth()
    // useEffect(() => {
    //     if (!moneyRequest) return
    //     if (!message) return
    //     moneyRequest.by_me = moneyRequest.by_me || message.ogMoneyRequest?.by_me || false
    //     moneyRequest.from = moneyRequest.from || message.ogMoneyRequest?.from || chat?.from
    // }, [moneyRequest, message, user, chat])

    const accept = async () => {
        if (!moneyRequest || processing) return
        setProcessing(true)
        const toastId = toast.loading("Accepting money request...")
        router.post(route('money.accept' as RouteName, {
            moneyRequest: moneyRequest?.uuid,
        }), {}, {
            onSuccess: () => {
                setProcessing(false)
                toast.success("Requested accept!")
                toast.dismiss(toastId)
                onSuccess?.()
            },
            onError: () => {
                setProcessing(false)
                toast.error("Failed to accept request")
                console.error("Error accept request")
                toast.dismiss(toastId)
            },
            only: ['messages', 'chats'],
            preserveScroll: true,
            onFinish: () => {
                setProcessing(false)
                setTimeout(() => {
                    toast.dismiss(toastId)
                }, 1000)
            }
        })
    }
    const release = async () => {
        if (!moneyRequest || processing) return
        if (moneyRequest.released_at || moneyRequest.by_me) return
        setProcessing(true)
        const toastId = toast.loading("Releasing money request...")
        router.post(route('money.release' as RouteName, {
            moneyRequest: moneyRequest?.uuid,
        }), {}, {
            onSuccess: () => {
                setProcessing(false)
                if (message?.by_me) {
                    toast.success(`Success! ${moneyRequest.amount} BDT has been received!`)
                } else {
                    toast.success(`Success! ${moneyRequest.amount} BDT has been sent!`)
                }
                toast.dismiss(toastId)
                onSuccess?.()
            },
            onError: () => {
                setProcessing(false)
                toast.error("Failed to release request")
                console.error("Error release request")
                toast.dismiss(toastId)
            },
            onFinish: () => {
                setProcessing(false)
                setTimeout(() => {
                    toast.dismiss(toastId)
                }, 1000)
            },
            only: ['messages', 'chats'],
            preserveScroll: true
        })
    }
    const reject = async () => {
        if (!moneyRequest || processing) return
        setProcessing(true)
        const toastId = toast.loading("Rejecting money request...")
        router.post(route('money.reject' as RouteName, {
            moneyRequest: moneyRequest?.uuid,
        }), {}, {
            onSuccess: () => {
                setProcessing(false)
                toast.success("Requested rejected!")
                toast.dismiss(toastId)
                onSuccess?.()
            },
            onError: () => {
                setProcessing(false)
                toast.error("Failed to reject request")
                console.error("Error rejecting request")
                toast.dismiss(toastId)
            },
            onFinish: () => {
                setProcessing(false)
                setTimeout(() => {
                    toast.dismiss(toastId)
                }, 1000)
            },
            only: ['messages', 'chats'],
            preserveScroll: true
        })
    }

    const cancel = async () => {
        if (!moneyRequest || processing) return
        setProcessing(true)
        const toastId = toast.loading("Cancelling money request...")
        router.post(route('money.cancel' as RouteName, {
            moneyRequest: moneyRequest?.uuid,
        }), {}, {
            onSuccess: () => {
                setProcessing(false)
                toast.success("Cancelled request!")
                toast.dismiss(toastId)
                onSuccess?.()
            },
            onError: () => {
                setProcessing(false)
                toast.error("Failed to cancel request")
                console.error("Error cancel request")
                toast.dismiss(toastId)
            },
            onFinish: () => {
                setProcessing(false)
                setTimeout(() => {
                    toast.dismiss(toastId)
                }, 1000)
            },
            only: ['messages', 'chats'],
            preserveScroll: true
        })
    }

    const requestRelease = async () => {
        if (!moneyRequest || processing) return
        setProcessing(true)
        const toastId = toast.loading("Requesting release...")
        router.post(route('money.request-release' as RouteName, {
            moneyRequest: moneyRequest?.uuid,
        }), {}, {
            onSuccess: () => {
                setProcessing(false)
                toast.success("Requested release")
                toast.dismiss(toastId)
                onSuccess?.()
            },
            onError: () => {
                setProcessing(false)
                toast.error("Failed to request release")
                console.error("Error release request")
                toast.dismiss(toastId)
            },
            onFinish: () => {
                setProcessing(false)
                setTimeout(() => {
                    toast.dismiss(toastId)
                }, 1000)
            },
            only: ['messages', 'chats'],
            preserveScroll: true
        })
    }

    return {
        moneyRequest,
        message,
        processing,
        accept,
        release,
        reject,
        cancel,
        requestRelease,
        pending,
        fetching
    }
}

