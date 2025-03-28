import { Button } from '@/components/ui/button';
import useBreakpoint from '@/Hooks/useBrakpoints';
import useMoneyRequest from '@/Hooks/useMoneyRequest';
import { useConfirmStore } from '@/stores/useConfirmStore';
import { ChatData, MessageData } from '@/types/_generated';
import { cn, transform } from '@/utils';
import { format, parseISO } from 'date-fns';
import { Card } from 'primereact/card';
import toast from 'react-hot-toast';

export default function MoneyRequestMessage({ message, chat }: { message: MessageData; chat: ChatData }) {
    const { processing, accept, reject, release, cancel, requestRelease, moneyRequest } = useMoneyRequest(message, chat);

    const { min } = useBreakpoint();
    const { user } = useAuth()
    useEffect(() => {
        message.ogMoneyRequest = message.ogMoneyRequest || message.moneyRequest
    }, [message])
    const onActionBase = useConfirmStore((state) => state.onAction);
    const onAction = (callback: (...params: any) => any) => {
        if (message.moneyRequest?.reported_at) {
            toast.error('Can not perform action on reported money request');
            return;
        }
        if (message.moneyRequest?.cancelled_at) {
            toast.error('Can not perform action on cancelled money request');
            return;
        }
        if (message.moneyRequest?.rejected_at) {
            toast.error('Can not perform action on rejected money request');
            return;
        }
        if (message.moneyRequest?.released_at) {
            toast.error('Can not perform action on released money request');
            return;
        }
        onActionBase(callback);
    };
    return (
        <div>
            <Card
                className={cn(
                    moneyRequest?.cancelled_at != null ||
                        moneyRequest?.rejected_at != null ||
                        moneyRequest?.released_at != null
                        ? 'disabled cursor-not-allowed opacity-75'
                        : '',
                    'max-sm:max-w-[230px]',
                )}
                pt={{
                    content: {
                        className: 'p-1 md:py-2',
                    },
                    body: {
                        className: 'px-2',
                    },
                }}>
                <div className="my-1 flex w-full flex-col flex-wrap items-center justify-center">
                    <div
                        className={cn(
                            'text-center text-base font-bold',
                            moneyRequest?.by_me ? 'text-green-500' : 'text-red-500',
                        )}>
                        {moneyRequest?.by_me ? '+' : '-'}
                        {moneyRequest?.amount.toFixed(2)} BDT
                    </div>
                    <div className="text-sm font-medium mb-1">
                        {
                            (moneyRequest?.cancelled_at != null || moneyRequest?.released_at != null) && message.ogMoneyRequest?.admin_note ? message.ogMoneyRequest?.admin_note : <>
                                {moneyRequest?.status == 'pending' && "Money Request Pending"}
                                {moneyRequest?.status == 'Request Accepted' && "Money Request Accepted"}
                                {moneyRequest?.status === 'waiting for release' && <>
                                    {(moneyRequest?.by_me) ? "Request Release Pending" : `${moneyRequest.from?.name} sent request to release`}
                                </>}
                                {moneyRequest?.status === 'rejected' && "Money Request Rejected"}
                                {moneyRequest?.status === 'cancelled' && "Money Request Cancelled"}
                                {
                                    !(
                                        moneyRequest?.status == 'pending'
                                        || moneyRequest?.status == 'waiting for release'
                                        || moneyRequest?.status === 'Request Accepted'
                                        || moneyRequest?.status === 'cancelled'
                                        || moneyRequest?.status === 'rejected'
                                    ) && `${moneyRequest?.by_me ? 'You' : moneyRequest?.from?.name} have requested money`
                                }
                            </>
                        }
                    </div>
                    {moneyRequest && (
                        <div className="mb-1">
                            <Countdown moneyRequest={moneyRequest} />
                        </div>
                    )}
                    {
                        moneyRequest?.status === 'pending' &&
                        <div className="flex items-center justify-center gap-2">
                            <Button
                                type="button"
                                disabled={message.moneyRequest?.accepted_at != null}
                                onClick={(e) => {
                                    if (!moneyRequest?.by_me) {
                                        onAction(accept);
                                    }
                                }}
                                variant={
                                    moneyRequest?.by_me ? 'warning' : 'success'
                                }
                                loading={processing} >
                                {moneyRequest?.by_me ? 'Pending' : 'Accept'}
                            </Button>
                            {!moneyRequest?.accepted_at && (
                                <Button
                                    type="button"
                                    disabled={message.ogMoneyRequest?.rejected_at != null || message.ogMoneyRequest?.cancelled_at != null || message.ogMoneyRequest?.released_at != null || message.ogMoneyRequest?.accepted_at != null}
                                    onClick={(e) => {
                                        if (moneyRequest?.by_me) {
                                            onAction(cancel);
                                        } else {
                                            onAction(reject);
                                        }
                                    }}
                                    variant="destructive"
                                    loading={processing}>
                                    {moneyRequest?.by_me
                                        ? 'Cancel'
                                        : 'Reject'}
                                </Button>
                            )}
                        </div>
                    }
                    {
                        moneyRequest?.status === 'Request Accepted' && moneyRequest?.by_me &&
                        <Button
                            onClick={(e) => {
                                if (moneyRequest?.by_me) {
                                    onAction(requestRelease);
                                }
                            }}
                            disabled={message.ogMoneyRequest?.released_at != null || message.ogMoneyRequest?.rejected_at != null || message.ogMoneyRequest?.cancelled_at != null || message.ogMoneyRequest?.reported_at != null || message.ogMoneyRequest?.release_requested_at != null}
                            className="text-black bg-[#D8BBFF]"
                            type='button'>{
                                message.ogMoneyRequest?.release_requested_at ? 'Release Requested' : 'Request Release'
                            }</Button>
                    }
                    {
                        moneyRequest?.status === 'waiting for release' && !moneyRequest?.by_me &&
                        <Button type="button"
                            disabled={message.ogMoneyRequest?.released_at != null || message.ogMoneyRequest?.rejected_at != null || message.ogMoneyRequest?.cancelled_at != null || message.ogMoneyRequest?.reported_at != null}
                            onClick={(e) => {
                                onAction(release);
                            }} variant="warning" loading={processing}>
                            Release
                        </Button>
                    }
                    {
                        !(moneyRequest?.status == 'pending' || moneyRequest?.status == 'waiting for release' || moneyRequest?.status === 'Request Accepted') &&
                        <Button
                            disabled
                            variant={
                                moneyRequest?.released_at ? 'success' : 'destructive'
                            }
                        >
                            {moneyRequest?.reported_at
                                ? (moneyRequest.reported_by == user.id ? 'Report submitted' : `Reported by ${moneyRequest?.from?.name}`)
                                : `Transaction ${moneyRequest?.status == 'completed' ? 'Successfull' : transform(moneyRequest?.status, 'title')}`
                            }
                        </Button>
                    }
                </div>
            </Card >
            <span
                className={cn(
                    'mt-1 !text-xs !font-normal !text-gray-400',
                    moneyRequest?.by_me ? 'text-end' : 'text-start',
                )}>
                {format(parseISO(message.created_at as string), 'hh:mm a')}
            </span>
        </div >
    );
}
