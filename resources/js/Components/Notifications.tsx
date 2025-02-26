import { Button } from "primereact/button";
import { Sidebar } from "primereact/sidebar";
import Notification from "./Notification";
import { usePage } from "@inertiajs/react";
import { Echo } from "@/echo";

export default function Notifications() {
    const [showNotifications, setShowNotifications] = useState(false);
    const [notifications, setNotifications] = useState<object[]>(usePage().props.notifications as object[]);
    const { user } = useAuth();
    useEffect(() => {
        Echo.leaveChannel('notifications.' + user?.id)
        Echo.channel('notifications.' + user?.id)
            .listen('MoneyRequestUpdated', (e: any) => {
                console.log(e)
            })
    }, [notifications])
    return (
        <>
            <Button className="!p-1.5 border border-white" text rounded onClick={() => setShowNotifications(true)}>
                <FlowbiteBellRingSolid className="text-white w-8 h-8" />
            </Button>

            <Sidebar pt={{
                header: {
                    className: "bg-gray-50 border-b shadow,"
                }
            }} visible={showNotifications} position="right" header={
                <div className="font-bold text-lg">Notifications</div>
            } className="w-[380px] sm:w-[420px] bg-white" onHide={() => setShowNotifications(false)}>
                <div className="my-4">
                    <div className="flex flex-col gap-2 h-full">
                        {
                            notifications.map(notification => (
                                <Notification notification={notification} />
                            ))
                        }
                    </div>
                </div>
            </Sidebar>
        </>
    )
}
