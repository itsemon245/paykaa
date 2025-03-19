import { Button } from "@/components/ui/button";
import { cn } from "@/lib/utils";
import { useConfirmStore } from "@/stores/useConfirmStore";
import { ChatData, MessageData, MoneyRequestData } from "@/types/_generated";

interface MoneyRequestActionsProps {
    moneyRequest?: MoneyRequestData;
    chat: ChatData;
    onSuccess?: () => void;
}
export default function MoneyRequestActions({
    moneyRequest,
    chat,
    onSuccess,
}: MoneyRequestActionsProps) {
    if (!moneyRequest) return
    const { accept, release, requestRelease, cancel, processing, reject } = useMoneyRequest(undefined, chat, onSuccess)
    const onAction = useConfirmStore(state => state.onAction)

    return (
        <div className="mt-2">
            {moneyRequest.accepted_at && <div className="text-center !text-red-500 text-xs !font-bold">Locked</div>}
            <div className="relative justify-center text-lg font-medium mb-1 flex flex-wrap items-center md:gap-2">
                <div className="text-center">{moneyRequest.by_me ? "You have " : `${moneyRequest?.from?.name} has `} requested
                </div>
                <div className={cn("font-bold text-center", moneyRequest?.by_me ? 'text-green-500' : 'text-red-500')}>{(moneyRequest.by_me ? '+' : '-') + moneyRequest?.amount} BDT </div>

            </div>
            {moneyRequest && <div className="mb-1">
                <Countdown moneyRequest={moneyRequest} />
            </div>
            }
            <div className="flex flex-col gap-2">
                <div className="grid grid-cols-2 items-center gap-2 justify-center">
                    <Button type="button" onClick={e => {
                        if (!moneyRequest.by_me) {
                            onAction(accept);
                        }
                    }} variant={moneyRequest.by_me && moneyRequest.accepted_at == null ? 'warning' : 'success'} loading={processing} disabled={moneyRequest.accepted_at != null} className={cn(moneyRequest.accepted_at && '!cursor-not-allowed col-span-2', moneyRequest.by_me && 'cursor-not-allowed')}>{moneyRequest.accepted_at ? 'Accepted' : moneyRequest.by_me ? 'Pending' : 'Accept'}</Button>
                    {!moneyRequest.accepted_at &&
                        <Button type="button" onClick={e => {
                            if (moneyRequest.by_me) {
                                onAction(cancel);
                            } else {
                                onAction(reject);
                            }
                        }} variant="destructive" loading={processing} disabled={moneyRequest.cancelled_at != null || moneyRequest.rejected_at != null} className="disabled:cursor-not-allowed">{
                                moneyRequest.cancelled_at != null ? 'Cancelled' : moneyRequest.rejected_at != null ? 'Rejected' : moneyRequest.by_me ? 'Cancel' : 'Reject'
                            }</Button>
                    }
                    {
                        moneyRequest.accepted_at && moneyRequest.by_me && <Button type="button" onClick={e => onAction(requestRelease)} loading={processing} disabled={moneyRequest.release_requested_at != null} className="col-span-2 disabled:cursor-not-allowed text-black bg-[#D8BBFF]">{
                            moneyRequest.release_requested_at ? 'Release Requested' : 'Request Release'
                        }</Button>
                    }
                    {
                        moneyRequest.release_requested_at && <Button type="button" variant={moneyRequest.released_at ? "success" : "warning"} onClick={e => onAction(release)} loading={processing} disabled={moneyRequest.released_at != null} className={cn("col-span-2", (moneyRequest.by_me || moneyRequest.released_at != null) && 'cursor-not-allowed')}>{
                            moneyRequest.by_me ? 'Waiting for Release' : moneyRequest.released_at ? 'Completed' : 'Please Release'
                        }</Button>
                    }
                </div>

            </div>

        </div >

    )
}
