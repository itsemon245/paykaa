import useBreakpoint from "@/Hooks/useBrakpoints";
import useMoneyRequest from "@/Hooks/useMoneyRequest";
import { RouteName } from "@/types";
import { ChatData, MessageData, MoneyRequestData } from "@/types/_generated";
import { cn, defaultAvatar } from "@/utils";
import { router, usePage } from "@inertiajs/react";
import { format, parseISO } from "date-fns";
import { Button } from "primereact/button";
import { Card } from "primereact/card";
import { Tag } from "primereact/tag";
import toast from "react-hot-toast";

export default function MoneyRequestMessage({ message, chat }: { message: MessageData, chat: ChatData }) {

    const { min } = useBreakpoint();

    const getSeverity = (moneyRequest: MoneyRequestData) => {
        if (moneyRequest.cancelled_at) {
            return "danger"
        }
        if (moneyRequest.status === 'completed') {
            return "success"
        }
        if (moneyRequest.status === 'waiting for release') {
            return !message.by_me && "warning"
        }
        if (moneyRequest.rejected_at) {
            return "danger"
        }
        if (moneyRequest.accepted_at) {
            return undefined
        }
        return "warning"
    }

    const getStatus = (moneyRequest: MoneyRequestData) => {
        if (moneyRequest.status === 'approved') {
            return message.by_me ? "Request release" : "Accepted"
        }
        if (moneyRequest.status === 'waiting for release') {
            return !message.by_me ? "Please Release" : "Waiting for Release"
        }
        return moneyRequest.status
    }

    const { processing, accept, release, reject, cancel, requestRelease } = useMoneyRequest(message)

    const UserButtons = ({ moneyRequest }: { moneyRequest: MoneyRequestData }) => {
        if (moneyRequest.status !== 'pending') {
            return <Button onClick={e => {
                if (moneyRequest.status === 'waiting for release' && !message.by_me) {
                    release();
                    return;
                }

            }} rounded severity={getSeverity(moneyRequest as MoneyRequestData)} className="!rounded-lg w-full justify-center *:!font-bold *:!w-max" label={processing ? 'Proccessing...' : getStatus(moneyRequest as MoneyRequestData)} size="small" />
        }
        return (
            <div className="grid grid-cols-2 items-center gap-3">
                <Button onClick={accept} rounded severity="success" className="!rounded-lg justify-center *:!font-bold" label={processing ? 'Processing...' : 'Accept'} icon="pi pi-check" size="small" />
                <Button onClick={reject} rounded severity="danger" className="!rounded-lg justify-center *:!font-bold" label={processing ? 'Processing...' : 'Reject'} icon="pi pi-times" size="small" />
            </div>
        )
    }

    const MyButtons = ({ moneyRequest }: { moneyRequest: MoneyRequestData }) => {
        return (<div className="flex items-center gap-2">
            <Button onClick={e => {
                if (moneyRequest.status === 'approved') {
                    requestRelease();
                }
            }} rounded severity={getSeverity(moneyRequest as MoneyRequestData)} className="!rounded-lg w-full justify-center *:!font-bold *:!w-max" label={processing ? 'Proccessing...' : getStatus(moneyRequest as MoneyRequestData)} size="small" />
            {!moneyRequest?.cancelled_at && !moneyRequest.accepted_at && !moneyRequest.rejected_at && <Button onClick={cancel} rounded severity="danger" className="!rounded-lg w-full justify-center *:!font-bold *:!w-max" label={processing ? 'Proccessing...' : 'Cancel'} size="small" />
            }
        </div>
        )
    }
    return (
        <div className={cn("message", message.by_me ? "me" : "")}>
            {!message.by_me && (
                <img
                    className={min('md') ? "avatar-md me-2" : "avatar-sm me-2"}
                    src={chat.from?.avatar}
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
                <Card className="max-sm:max-w-[220px]" pt={{
                    content: {
                        className: "p-1 md:py-2",
                    }
                }}>
                    <div className="text-center text-xs font-medium">Money Request</div>
                    <div className="text-center md:text-lg font-bold my-1.5 text-green-600">{message.moneyRequest?.amount.toFixed(2)} BDT</div>
                    <div className="text-sm font-medium mb-2 flex items-center gap-2">{message.by_me ? "You have " : `${message.moneyRequest?.from?.name} has `} requested Money
                    </div>
                    {message.by_me ?
                        <MyButtons moneyRequest={message.moneyRequest as MoneyRequestData} />
                        : <UserButtons moneyRequest={message.moneyRequest as MoneyRequestData} />

                    }
                </Card>
                <span className={cn("!text-gray-400 mt-1 !font-normal !text-xs", message.by_me ? 'text-end' : 'text-start')}>{format(parseISO(message.created_at as string), 'hh:mm a')}</span>
            </div>
        </div>
    )
}

