import { Button } from "@/components/ui/button"
import { useConfirmStore } from "@/stores/useConfirmStore"
import { MoneyRequestData } from "@/types/_generated"
import { router } from "@inertiajs/react"
import toast from "react-hot-toast"

export default function ReportMoneyRequest({ moneyRequest }: { moneyRequest: MoneyRequestData }) {
    const { expired } = useCountdown(moneyRequest)
    const [reported, setReported] = useState(moneyRequest.reported_at != null)
    const setOpen = useConfirmStore((state) => state.setOpen);
    const setOnConfirm = useConfirmStore((state) => state.setOnConfirm);
    const handleReport = () => {
        setOpen(true)
        setOnConfirm(report)
    }
    const report = async () => {
        const toastId = toast.loading("Reporting money request...")
        router.post(
            '/money-request/' + moneyRequest.uuid + '/report', {},
            {
                preserveState: true,
                preserveScroll: true,
                onSuccess: (data) => {
                    if (data.props.error) {
                        toast.error(data.props.error, {
                            id: toastId,
                        })
                        return;
                    }
                    toast.success("Reported successfully!", {
                        id: toastId,
                    })
                    setReported(true)
                },
                onError: (error) => {
                    console.error("Error reporting money request", error)
                    toast.error("Error reporting money request!", {
                        id: toastId,
                    })
                },
                onFinish: () => {
                    setTimeout(() => toast.dismiss(toastId), 1000)
                }
            })
    }
    if (expired) {
        return (
            <div className="flex items-center justify-center gap-2 flex-wrap">
                <div className="text-center">
                    {moneyRequest.by_me ? 'Buyer' : 'Seller'} did not complete the transaction?
                </div>
                <Button disabled={reported} onClick={handleReport} variant="destructive" size="sm" className="!text-xs disabled:cursor-not-allowed">{
                    reported ? 'Already Reported' : 'Report'
                }</Button>
            </div>
        )
    }

}
