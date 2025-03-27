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
    const { processing, accept, reject, release, cancel, moneyRequest } = useMoneyRequest(message, chat);

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
                <div className="my-1 flex w-full flex-col flex-wrap items-center justify-center gap-1">
                    <div
                        className={cn(
                            'mb-0.5 text-center text-base font-bold',
                            moneyRequest?.by_me ? 'text-green-500' : 'text-red-500',
                        )}>
                        {moneyRequest?.by_me ? '+' : '-'}
                        {moneyRequest?.amount.toFixed(2)} BDT
                    </div>
                    <div className="text-sm font-medium">
                        {moneyRequest?.status == 'pending' && "Money Request Pending"}
                        {moneyRequest?.status == 'Request Accepted' && "Money Request Accepted"}
                        {moneyRequest?.status === 'waiting for release' && <>
                            {moneyRequest?.by_me ? "Request Release Pending" : `${moneyRequest.from?.name} sent request to release`}
                        </>}
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
                                onClick={(e) => {
                                    if (!moneyRequest?.by_me) {
                                        onAction(accept);
                                    }
                                }}
                                variant="success"
                                loading={processing} >
                                {moneyRequest?.by_me ? 'Pending' : 'Accept'}
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
                                    loading={processing}>
                                    {moneyRequest?.by_me
                                        ? 'Cancel'
                                        : 'Reject'}
                                </Button>
                            )}
                        </div>
                    }
                    {
                        moneyRequest?.status === 'waiting for release' && moneyRequest?.by_me &&
                        <Button type="button" onClick={(e) => {
                            onAction(release);
                        }} variant="destructive" loading={processing}>
                            Release
                        </Button>
                    }
                </div>
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
