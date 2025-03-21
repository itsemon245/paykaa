import { Badge } from "@/components/ui/badge";
import { Button } from "@/components/ui/button";
import useBreakpoint from "@/Hooks/useBrakpoints";
import useMoneyRequest from "@/Hooks/useMoneyRequest";
import { useConfirmStore } from "@/stores/useConfirmStore";
import { RouteName } from "@/types";
import { ChatData, MessageData, MoneyRequestData } from "@/types/_generated";
import { cn, defaultAvatar } from "@/utils";
import { router, usePage } from "@inertiajs/react";
import { format, parseISO } from "date-fns";
import { Card } from "primereact/card";
import { Tag } from "primereact/tag";
import toast from "react-hot-toast";

export default function MoneyRequestMessage({ message, chat }: { message: MessageData, chat: ChatData }) {
    const { processing, accept, reject, cancel, moneyRequest } = useMoneyRequest(message, chat)

    const { min } = useBreakpoint();
    const onAction = useConfirmStore(state => state.onAction)

    return (
        <div className={cn("message money-request", message.by_me ? "me" : "")}>
            {!message.by_me && (
                <img
                    className={min('md') ? "avatar-md me-2" : "avatar-sm me-2"}
                    src={message.from?.avatar}
                    onError={(e) => {
                        //@ts-ignore
                        e.target.src = defaultAvatar
                    }}

                    data-toggle="tooltip"
                    data-placement="top"
                    title={chat.from?.name}
                    alt="avatar"
                />
            )}

            <div>
                <Card className={cn(message.moneyRequest?.cancelled_at != null || message.moneyRequest?.rejected_at != null || message.moneyRequest?.released_at != null ? "opacity-75 cursor-not-allowed disabled" : '', "max-sm:max-w-[230px]")} pt={{
                    content: {
                        className: "p-1 md:py-2",
                    },
                    body: {
                        className: "px-2",
                    }
                }}>
                    <div className="text-center text-xs font-medium">Money Request</div>
                    <div className="flex items-center justify-center w-full gap-1 flex-wrap my-1">
                        {
                            moneyRequest && (
                                moneyRequest.released_at != null
                                && moneyRequest.cancelled_at != null
                                && moneyRequest.rejected_at != null
                            ) ?
                                <>
                                    {
                                        moneyRequest.release_requested_at
                                            ? <>
                                                {
                                                    moneyRequest.by_me ?
                                                        <>
                                                            <div className={cn("text-center text-sm font-bold", message.by_me ? 'text-green-500' : 'text-red-500')}>{message.by_me ? '+' : '-'}{message.moneyRequest?.amount.toFixed(2)} BDT</div>
                                                            <div className="text-center text-sm font-medium">request release pending</div>
                                                        </>
                                                        :
                                                        <>
                                                            <div className="text-sm font-medium">{moneyRequest.from?.name} sent request release, check your money form</div>
                                                        </>

                                                }
                                            </>
                                            :
                                            <>
                                                <div className="text-sm font-medium">{message.by_me ? "You" : `${message.moneyRequest?.from?.name}`} requested</div>
                                                <div className={cn("text-center text-base font-bold mb-0.5", message.by_me ? 'text-green-500' : 'text-red-500')}>{message.by_me ? '+' : '-'}{message.moneyRequest?.amount.toFixed(2)} BDT</div>

                                            </>
                                    }

                                </>
                                :
                                <>
                                    {
                                        moneyRequest?.reported_at
                                            ?
                                            <div className="text-sm font-medium">
                                                <div className="text-center font-bold">Report from {moneyRequest.from?.id == moneyRequest.reported_by ? moneyRequest.from?.name : 'Yourself'}</div>
                                                <div>Entire transaction is now locked</div>
                                            </div>
                                            :
                                            <>
                                                <div className={cn("text-center text-base font-bold mb-0.5", message.by_me ? 'text-green-500' : 'text-red-500')}>{message.by_me ? '+' : '-'}{message.moneyRequest?.amount.toFixed(2)} BDT</div>
                                                <div className="text-sm font-medium">Money request {moneyRequest?.status}</div>
                                            </>
                                    }
                                </>
                        }
                    </div>
                    {message.moneyRequest && <div className="mb-1">
                        <Countdown moneyRequest={message.moneyRequest} />
                    </div>}
                    {!moneyRequest?.accepted_at && !moneyRequest?.released_at && !moneyRequest?.cancelled_at && !moneyRequest?.rejected_at ? <>
                        <div className="flex items-center gap-2 justify-center">
                            <Button type="button" onClick={e => {
                                if (!moneyRequest?.by_me) {
                                    onAction(accept);
                                }
                            }} variant={moneyRequest?.by_me && moneyRequest?.accepted_at == null ? 'warning' : 'success'} loading={processing} disabled={moneyRequest?.accepted_at != null} className={cn(moneyRequest?.accepted_at && '!cursor-not-allowed col-span-2', moneyRequest?.by_me && 'cursor-not-allowed')}>{moneyRequest?.accepted_at ? 'Accepted' : moneyRequest?.by_me ? 'Pending' : 'Accept'}</Button>
                            {!message.moneyRequest?.accepted_at &&
                                <Button type="button" onClick={e => {
                                    if (moneyRequest?.by_me) {
                                        onAction(cancel);
                                    } else {
                                        onAction(reject);
                                    }
                                }} variant="destructive" loading={processing} disabled={moneyRequest?.cancelled_at != null || moneyRequest?.rejected_at != null} className="disabled:cursor-not-allowed">{
                                        moneyRequest?.cancelled_at != null ? 'Cancelled' : moneyRequest?.rejected_at != null ? 'Rejected' : moneyRequest?.by_me ? 'Cancel' : 'Reject'
                                    }</Button>
                            }
                        </div>
                    </> : <>
                        <div className="flex items-center gap-2 justify-center">
                            {
                                moneyRequest?.released_at ?
                                    <Button variant="success" className="w-full cursor-not-allowed">Completed</Button>
                                    : <>
                                        {
                                            !moneyRequest?.reported_at ?
                                                <Button
                                                    variant={
                                                        !moneyRequest?.cancelled_at
                                                            && !moneyRequest?.rejected_at
                                                            ? "warning" : "destructive"
                                                    }
                                                    className="cursor-not-allowed w-full !capitalize" >{
                                                        !moneyRequest?.cancelled_at
                                                            && !moneyRequest?.rejected_at
                                                            ? moneyRequest.status
                                                            : "Cancelled"
                                                    }
                                                </Button>
                                                : <Button disabled variant="destructive" className="w-full">{moneyRequest.status}</Button>
                                        }
                                    </>

                            }
                        </div>
                    </>}
                </Card>
                <span className={cn("!text-gray-400 mt-1 !font-normal !text-xs", message.by_me ? 'text-end' : 'text-start')}>{format(parseISO(message.created_at as string), 'hh:mm a')}</span>
            </div>
        </div >
    )
}

