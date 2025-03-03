import { Button } from "primereact/button";
import { Sidebar } from "primereact/sidebar";
import Notification from "./Notification";
import { Link, usePage } from "@inertiajs/react";
import { Echo } from "@/echo";
import { Toast } from "primereact/toast";
import { MoneyRequestData } from "@/types/_generated";
import { cn } from "@/utils";
import { Badge } from "primereact/badge";
import { Avatar } from "primereact/avatar";

export default function Notifications({ newNotification }: { newNotification?: object }) {
    const [showNotifications, setShowNotifications] = useState(false);
    const notifications = usePage().props.notifications as object[];
    const hasUnreadNotifications = notifications.filter((notification: any) => notification.read_at === null).length > 0;
    const { user } = useAuth();
    useEffect(() => {
        Echo.leaveChannel('notifications.' + user?.id)
        Echo.channel('notifications.' + user?.id)
            .listen('MoneyRequestUpdated', (e: any) => {
                showSticky(e.notification)
            })
    }, [notifications])
    const toast = useRef<Toast>(null);
    const unreadNotifications = notifications.filter((notification: any) => notification.read_at === null);
    const unreadCount = unreadNotifications.length > 0 ? unreadNotifications.length.toString() : undefined;

    const showSticky = (notification: object) => {
        //@ts-ignore
        const moneyRequest = notification.data.moneyRequest as MoneyRequestData
        //@ts-ignore
        const moneyRequestType = notification.data.moneyRequestType ?? (moneyRequest.sender_id === user.id ? 'incoming' : 'outgoing');
        toast.current?.show({
            severity: moneyRequest.sender_id === user?.id ? 'success' : 'warn',
            summary: <div>
                Money Request for <span className={cn(moneyRequestType === 'incoming' ? 'text-green-500' : 'text-red-500')}>{
                    moneyRequestType === 'incoming' ? '+' : '-'} {moneyRequest.amount} BDT</span></div>,
            sticky: true,
            content: (props) => (
                <div className="flex flex-column align-items-left" style={{ flex: '1' }}>
                    <div className="flex align-items-center gap-2">
                        <Avatar image={moneyRequest.from?.avatar} shape="circle" />
                        <span className="font-bold text-900">{moneyRequest.from?.name}</span>
                    </div>
                    <div className="font-medium text-lg my-3 text-900">{props.message.summary}</div>
                    <Link href={route('chat.receiver-chat', { receiver: moneyRequest.from?.uuid })}>
                        <Button className="p-button-sm flex" label="Open Chat" severity="success"></Button>
                    </Link>
                </div>
            )
        });
        toast.current?.show({ severity: 'info', summary: 'Sticky', detail: 'Message Content', sticky: true });
    };
    useEffect(() => {
        if (newNotification) {
            showSticky(newNotification);
        }
    }, [newNotification])

    return (
        <>
            <Toast ref={toast} />
            <Button className="!p-1.5 border border-white relative" text rounded onClick={() => setShowNotifications(true)}>
                {unreadCount && <Badge className="absolute -top-1 -right-1 text-white bg-red-500 h-5 w-5 flex items-center justify-center" size="normal" value={unreadCount}></Badge>}
                <FlowbiteBellRingSolid className="text-white w-8 h-8" />
            </Button >

            <Sidebar pt={{
                header: {
                    className: "bg-gray-50"
                }
            }} visible={showNotifications} position="right" header={
                <div className="font-bold text-lg">Notifications</div>
            } className="w-[380px] sm:w-[420px] bg-white" onHide={() => setShowNotifications(false)}>
                <div className="my-3">
                    <div className="flex justify-end gap-3">
                        {
                            notifications.length > 0 && <Link only={['notifications']} href={route('notification.clear-all')} className="text-sm text-end font-medium mb-2">Clear all</Link>
                        }

                        {
                            hasUnreadNotifications &&
                            <div className="text-sm text-end font-medium mb-2">
                                <Link href={route('notification.mark-all-as-read')} only={['notifications']} >Mark all read</Link>
                            </div>
                        }
                    </div>
                    {notifications.length > 0 ? <div className="flex flex-col gap-2 h-full">
                        {
                            notifications.map(notification => (
                                <Notification notification={notification} />
                            ))
                        }
                    </div>
                        : <div className="flex flex-col gap-2 h-full items-center justify-center">
                            <NoItems value="No notifications" />
                        </div>}
                </div>
            </Sidebar>
        </>
    )
}
