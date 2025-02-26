export default function Notification({ notification }: { notification: any }) {
    useEffect(() => {
        console.log(notification)
    }, [notification])
    return <div>
        Notification
    </div>
}
