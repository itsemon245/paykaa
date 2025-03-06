import { ButtonSeverity } from "@/types";
import { MoneyRequestData, Status } from "@/types/_generated";
import { cn, defaultAvatar } from "@/utils";
import { Link } from "@inertiajs/react";
import { Avatar } from "primereact/avatar";
import { Tag, TagProps } from "primereact/tag";

export default function Notification({ notification }: { notification: any }) {
    const moneyRequest = notification.data.moneyRequest as MoneyRequestData
    const user = useAuth()
    const moneyRequestType = notification.data.moneyRequestType ?? (moneyRequest.sender_id === user.id ? 'incoming' : 'outgoing');
    const status = !moneyRequest.released_at && !moneyRequest.rejected_at && !moneyRequest.cancelled_at ? 'pending' : moneyRequest.status
    const getSeverity = () => {
        const severityMap: Record<Status, TagProps['severity']> = {
            pending: 'warning',
            completed: 'success',
            'waiting for release': 'warning',
            rejected: 'danger',
            cancelled: 'danger',
            'not verified': 'danger',
            approved: 'success',
            failed: 'danger',
        }
        return severityMap[status]
    }

    useEffect(() => {
        console.log(notification)
    }, [notification])
    return <div className={cn("py-2 px-3 border shadow-sm rounded-lg", notification.read_at ? 'opacity-50' : '')}>
        <div className="flex items-center justify-between">
            <div className="flex items-center gap-2">
                <Avatar image={moneyRequest.from?.avatar} shape="circle" imageFallback={defaultAvatar} />
                <div className="font-semibold text-sm">{moneyRequest.from?.name}</div>
            </div>
            <div className="text-xs">
                {moneyRequest.updated_at_human}
            </div>
        </div>
        <div className="mt-1 ms-4">
            <div className="flex items-center justify-between ">
                <div>Money request for <span className={cn(moneyRequestType === 'incoming' ? 'text-green-500' : 'text-red-500')}>{moneyRequestType === 'incoming' ? '+' : '-'} {moneyRequest.amount} BDT</span></div>
            </div>
            <div className="flex items-center  mt-2 gap-3">
                <div className="flex items-center gap-1">
                    <span className="font-semibold">Status:</span>
                    <Tag className="capitalize" severity={getSeverity()} value={status} />
                </div>
                {!moneyRequest.rejected_at
                    && !moneyRequest.cancelled_at
                    && !moneyRequest.released_at
                    && moneyRequest.from && <Link href={route('chat.receiver-chat', { receiver: moneyRequest.from.uuid })}>
                        <Tag className="capitalize" severity="info" value="Open Chat" />
                    </Link>}
            </div>
        </div>
    </div >
}
