import { Button } from '@/components/ui/button';
import useBreakpoint from '@/Hooks/useBrakpoints';
import useMoneyRequest from '@/Hooks/useMoneyRequest';
import { useConfirmStore } from '@/stores/useConfirmStore';
import { ChatData, MessageData } from '@/types/_generated';
import { cn } from '@/utils';
import { format, parseISO } from 'date-fns';
import { Card } from 'primereact/card';
import toast from 'react-hot-toast';

export default function MoneyRequestMessage({ message, chat }: { message: MessageData; chat: ChatData }) {
    const { processing, accept, reject, cancel, moneyRequest } = useMoneyRequest(message, chat);

    const { min } = useBreakpoint();
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
                <div className="my-1 flex w-full flex-wrap items-center justify-center gap-1">
                    {moneyRequest &&
                        moneyRequest.released_at != null &&
                        moneyRequest.cancelled_at != null &&
                        moneyRequest.rejected_at != null ? (
                        <>
                            <div className="text-sm font-medium">
                                {moneyRequest?.by_me ? 'You' : `${moneyRequest?.from?.name}`} requested
                            </div>
                            <div
                                className={cn(
                                    'mb-0.5 text-center text-base font-bold',
                                    moneyRequest?.by_me ? 'text-green-500' : 'text-red-500',
                                )}>
                                {moneyRequest?.by_me ? '+' : '-'}
                                {moneyRequest?.amount.toFixed(2)} BDT
                            </div>
                        </>
                    ) : (
                        <>
                            {moneyRequest?.reported_at ? (
                                <div className="text-sm font-medium">
                                    <div className="text-center font-bold">
                                        Report from{' '}
                                        {moneyRequest.from?.id == moneyRequest.reported_by
                                            ? moneyRequest.from?.name
                                            : 'Yourself'}
                                    </div>
                                    <div>Entire transaction is now locked</div>
                                </div>
                            ) : (
                                <>
                                    {moneyRequest?.status === 'waiting for release' ? (
                                        <>
                                            {moneyRequest.by_me ? (
                                                <>
                                                    <div
                                                        className={cn(
                                                            'text-center text-sm font-bold',
                                                            moneyRequest?.by_me ? 'text-green-500' : 'text-red-500',
                                                        )}>
                                                        {moneyRequest?.by_me ? '+' : '-'}
                                                        {moneyRequest?.amount.toFixed(2)} BDT
                                                    </div>
                                                    <div className="text-center text-sm font-medium">
                                                        request release pending
                                                    </div>
                                                </>
                                            ) : (
                                                <>
                                                    <div className="text-sm font-medium">
                                                        {moneyRequest.from?.name} sent request release, check your money
                                                        form
                                                    </div>
                                                </>
                                            )}
                                        </>
                                    ) : (
                                        <>
                                            <div
                                                className={cn(
                                                    'mb-0.5 text-center text-base font-bold',
                                                    moneyRequest?.by_me ? 'text-green-500' : 'text-red-500',
                                                )}>
                                                {moneyRequest?.by_me ? '+' : '-'}
                                                {moneyRequest?.amount.toFixed(2)} BDT
                                            </div>
                                            <div className="text-sm font-medium">
                                                Money request{' '}
                                                {moneyRequest?.status == 'Request Accepted'
                                                    ? 'accepted'
                                                    : moneyRequest?.status === 'completed'
                                                        ? 'successful'
                                                        : moneyRequest?.status?.toLowerCase()}
                                            </div>
                                        </>
                                    )}
                                </>
                            )}
                        </>
                    )}
                </div>
                {moneyRequest && (
                    <div className="mb-1">
                        <Countdown moneyRequest={moneyRequest} />
                    </div>
                )}
                {!moneyRequest?.accepted_at &&
                    !moneyRequest?.released_at &&
                    !moneyRequest?.cancelled_at &&
                    !moneyRequest?.rejected_at ? (
                    <>
                        <div className="flex items-center justify-center gap-2">
                            <Button
                                type="button"
                                onClick={(e) => {
                                    if (!moneyRequest?.by_me) {
                                        onAction(accept);
                                    }
                                }}
                                variant={
                                    moneyRequest?.by_me && moneyRequest?.accepted_at == null ? 'warning' : 'success'
                                }
                                loading={processing}
                                disabled={message.moneyRequest?.accepted_at != null}
                                className={cn(
                                    message.moneyRequest?.accepted_at && 'col-span-2 !cursor-not-allowed',
                                    moneyRequest?.by_me && 'cursor-not-allowed',
                                )}>
                                {moneyRequest?.accepted_at ? 'Accepted' : moneyRequest?.by_me ? 'Pending' : 'Accept'}
                            </Button>
                            {!moneyRequest?.accepted_at && (
                                <Button
                                    type="button"
                                    onClick={(e) => {
                                        if (moneyRequest?.by_me) {
                                            onAction(cancel);
                                        } else {
                                            onAction(reject);
                                        }
                                    }}
                                    variant="destructive"
                                    loading={processing}
                                    disabled={
                                        message.moneyRequest?.accepted_at != null ||
                                        message.moneyRequest?.cancelled_at != null ||
                                        message.moneyRequest?.rejected_at != null
                                    }
                                    className="disabled:cursor-not-allowed">
                                    {moneyRequest?.cancelled_at != null
                                        ? 'Cancelled'
                                        : moneyRequest?.rejected_at != null
                                            ? 'Rejected'
                                            : moneyRequest?.by_me
                                                ? 'Cancel'
                                                : 'Reject'}
                                </Button>
                            )}
                        </div>
                    </>
                ) : (
                    <>
                        <div className="flex items-center justify-center gap-2">
                            {moneyRequest?.released_at ? (
                                <Button variant="success" className="w-full cursor-not-allowed">
                                    Completed
                                </Button>
                            ) : (
                                <>
                                    {!moneyRequest?.reported_at ? (
                                        <Button
                                            variant={
                                                !moneyRequest?.cancelled_at && !moneyRequest?.rejected_at
                                                    ? 'warning'
                                                    : 'destructive'
                                            }
                                            className="w-full cursor-not-allowed !capitalize">
                                            {!moneyRequest?.cancelled_at && !moneyRequest?.rejected_at
                                                ? moneyRequest.status
                                                : 'Cancelled'}
                                        </Button>
                                    ) : (
                                        <Button disabled variant="destructive" className="w-full">
                                            Reported
                                        </Button>
                                    )}
                                </>
                            )}
                        </div>
                    </>
                )}
            </Card>
            <span
                className={cn(
                    'mt-1 !text-xs !font-normal !text-gray-400',
                    moneyRequest?.by_me ? 'text-end' : 'text-start',
                )}>
                {format(parseISO(message.created_at as string), 'hh:mm a')}
            </span>
        </div>
    );
}
