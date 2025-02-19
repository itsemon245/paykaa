import useBreakpoint from "@/Hooks/useBrakpoints";
import { Sidebar } from 'primereact/sidebar';
import { PaginatedCollection } from "@/types";
import { WalletData } from "@/types/_generated";
import { cn, titleCase, transform } from "@/utils";
import { router, usePage } from "@inertiajs/react";
import { format, parseISO } from "date-fns";
import { Avatar } from "primereact/avatar";
import { Card } from "primereact/card";
import { Column, ColumnBodyOptions } from "primereact/column";
import { DataTable, DataTableStateEvent } from "primereact/datatable";
import { Dialog } from "primereact/dialog";
import { Paginator, PaginatorPageChangeEvent } from "primereact/paginator";
import { Tag, TagProps } from "primereact/tag";

export default function Transactions() {
    const pageProps = usePage().props
    const { user } = useAuth()
    const initialTransactions = pageProps.transactions as PaginatedCollection<WalletData>
    const [transactions, setTransactions] = useState(initialTransactions)
    const [perPage, setPerPage] = useState(transactions.per_page)
    const [first, setFirst] = useState(0);
    const { min } = useBreakpoint()

    const [transactionItem, setTransactionItem] = useState<WalletData>()

    const getSenderNumber = (item: WalletData) => {
        if (item.transaction_type === "deposit") {
            return item.payment_number
        }
        if (item.transaction_type === "withdraw") {
            return item.depositMethod?.number
        }
        if (item.transaction_type === "transfer") {
            return item.type === 'credit' ? item.owner?.id : item.user?.id
        }
        return item.payment_number
    }
    const getReceiverNumber = (item: WalletData) => {
        if (item.transaction_type === "deposit") {
            return item.depositMethod?.number
        }
        if (item.transaction_type === "transfer") {
            return item.type === 'debit' ? item.owner?.id : item.user?.id
        }
        return item.payment_number
    }


    const getSeverity = (status: WalletData['status']): TagProps['severity'] => {
        switch (status) {
            case "approved":
                return "success";
            case "failed":
                return "danger";
            case "cancelled":
                return "danger";
            case "pending":
                return "warning"
            default:
                return "info";
        }
    }
    const transactionTypeBodyTemplate = (item: WalletData) => {
        const colors = {
            "deposit": "success",
            "withdraw": "warning",
            "transfer": "info",
        }
        const severity = colors[item.transaction_type as keyof typeof colors] as "success" | "info" | "warning" | "danger" | "secondary" | "contrast"
        return <Tag value={titleCase(item.transaction_type)} severity={severity}></Tag>;
    }
    const statusBodyTemplate = (item: WalletData) => {
        return <Tag value={item.status === 'cancelled' ? 'Rejected' : titleCase(item?.status || '')} severity={getSeverity(item.status)}></Tag>;
    };
    const amountBodyTemplate = (item: WalletData) => {
        const color = item.type !== "debit" ? "green-500" : "red-500"
        return <div className={`font-bold flex items-center gap-2`}>
            <div className={`text-${color}`}>{item.type === "debit" ? "-" : "+"}</div>
            {item.amount.toLocaleString('en-IN', { style: 'currency', currency: 'BDT' })}
        </div>
    }
    const slBodyTemplate = (item: WalletData, options: ColumnBodyOptions) => {
        return <div className="font-bold">{options.rowIndex + 1}</div>
    }
    const onPage = async (e: PaginatorPageChangeEvent) => {
        const url = route('wallet.transactions.index', {
            page: e.page + 1,
            per_page: e.rows,
        })
        router.visit(url, {
            replace: true,
            preserveScroll: true,
            preserveState: false,
            onSuccess() { setFirst(e.rows) }
        })
    }
    return (
        <>
            <Head title="Transactions" />
            <div className="container mx-auto my-6">
                <Card>
                    <h1 className="heading">Transactions</h1>
                    {min('sm') ? <DataTable className="rounded-lg overflow-hidden" emptyMessage={<div className="text-center font-bold">No Transactions Yet</div>} dataKey="uuid" totalRecords={transactions.total} value={transactions.data} rows={perPage} tableStyle={{ minWidth: '50rem' }}>
                        <Column field="id" className="!p-1" header="No." body={slBodyTemplate} style={{ width: 'max-content' }}></Column>
                        <Column field="created_at" body={(item) => format(parseISO(item.created_at), "PPp")} header="Date" className="!p-1 !w-[200px]"></Column>
                        <Column className="!p-1" field="amount" header="Amount" body={amountBodyTemplate} style={{ width: 'max-content' }}></Column>
                        <Column className="!p-1 capitalize" field="transaction_type" header="Type" body={item => item.transaction_type} style={{ width: 'max-content' }}></Column>
                        <Column className="!p-1" field="payment_number" header="Payment Details" style={{ width: 'max-content' }} body={(item: WalletData) => (
                            <div className="flex flex-col gap-2">
                                {item.transaction_type !== 'withdraw' && <div className="flex items-center gap-2">
                                    <div className="text-sm font-bold">Sender:</div>
                                    <div className="text-sm font-bold">{
                                        getSenderNumber(item)
                                    }</div>
                                </div>}

                                <div className="flex items-center gap-2">
                                    <div className="text-sm font-bold">Receiver:</div>
                                    <div className="text-sm font-bold">{getReceiverNumber(item)}</div>
                                </div>

                                {item.transaction_type !== 'transfer' && <div className="flex items-center gap-2">
                                    <div className="text-sm font-bold">Method:</div>
                                    <div className="text-sm font-bold">{item.transaction_type === "deposit" ? item.depositMethod?.label : item.withdrawMethod?.label}</div>
                                </div>
                                }
                            </div>
                        )}></Column>
                        {/*
                        <Column className="!p-1 capitalize" field="method" header="Method" style={{ width: 'max-content' }}></Column>
                        <Column className="!p-1" field="payment_number" header="Payment Number" style={{ width: 'max-content' }}></Column>
                        <Column className="!p-1" field="transaction_id" header="Transaction ID" style={{ width: 'max-content' }}></Column>
                        */}
                        <Column className="!p-1" field="approved_at" body={statusBodyTemplate} header="Status" style={{ width: 'max-content' }}></Column>
                    </DataTable> : <>
                        <div className="flex flex-col">
                            {transactions.data.map((item, index) => (
                                <div key={"transaction-" + item.uuid} className={cn("flex p-3 justify-between gap-2 border-l border-r", index == 0 && 'border-t border-b', index + 1 <= transactions.data.length && 'border-b')}>
                                    <div className="flex items-center gap-2">
                                        {/*<Avatar label={(index + 1).toString()} size="large" style={{ backgroundColor: 'var(--primary-500)', color: '#ffffff' }} shape="circle" />*/}
                                        <div>
                                            <div className="capitalize text-lg font-semibold">{item.transaction_type}</div>
                                            {
                                                item.transaction_type === 'deposit' && <div className="text-lg font-medium">To: {item.depositMethod?.number}</div>
                                            }
                                            {
                                                item.transaction_type === 'withdraw' && <div className="text-lg font-medium">To: {item.payment_number}</div>
                                            }
                                            <div>Status: {statusBodyTemplate(item)}</div>
                                        </div>
                                    </div>
                                    <div>
                                        <div className={cn("text-lg font-semibold flex items-center justify-end", item.type === "debit" ? 'text-red-500' : 'text-green-500')}>
                                            <span className="mb-1.5">{item.type === 'debit' ? '-' : '+'}</span><MdiCurrencyBdt className="h-5 w-5 mb-1" />{item.amount.toFixed(2)}
                                        </div>
                                        <div className="text-end">{
                                            format(parseISO(item.created_at as string), "p, dd/mm/yy")
                                        }</div>
                                        <div className="text-end font-bold">Method: {item.transaction_type === "deposit" ? item.depositMethod?.label : item.withdrawMethod?.label}</div>
                                        <MdiArrowRightDropCircleOutline className="ms-auto w-6 h-6 text-primary cursor-pointer" onClick={() => setTransactionItem(item)} />
                                    </div>
                                </div>
                            ))}
                        </div>
                    </>}
                    {transactionItem !== undefined && <Sidebar className="h-max" header={<div className="font-bold">{transform(transactionItem?.transaction_type, 'title')}</div>} visible={transactionItem !== undefined} position="bottom" onHide={() => setTransactionItem(undefined)}>
                        <div className="grid grid-cols-2 *:p-2 *:border *:border-collapse">
                            <div>
                                <div className="font-medium">Amount</div>
                                <div className={cn("text-lg font-semibold flex items-center")}>
                                    <MdiCurrencyBdt className="h-5 w-5 mb-1" />{transactionItem?.amount?.toFixed(2)}
                                </div>
                            </div>
                            <div>
                                <div className="font-medium">Time</div>
                                <div className={cn("text-lg font-semibold flex items-center")}>
                                    {format(parseISO(transactionItem?.created_at as string), "p, dd/mm/yy")}
                                </div>
                            </div>
                            {transactionItem.transaction_type !== 'withdraw' &&
                                <div>
                                    <div className="font-medium">Sender</div>
                                    <div className={cn("text-lg font-semibold flex items-center")}>
                                        {getSenderNumber(transactionItem)}
                                    </div>
                                </div>
                            }
                            <div>
                                <div className="font-medium">Receiver</div>
                                <div className={cn("text-lg font-semibold flex items-center")}>
                                    {getReceiverNumber(transactionItem)}
                                </div>
                            </div>
                            <div>
                                <div className="font-medium">Status</div>
                                <div className={cn("mt-1 text-lg font-semibold flex items-center")}>
                                    {statusBodyTemplate(transactionItem)}
                                </div>
                            </div>
                            {(transactionItem.depositMethod?.category === 'Mobile Banking' || transactionItem.withdrawMethod?.category === 'Mobile Banking') &&
                                <div>
                                    <div className="font-medium">Transaction ID:</div>
                                    <div className={cn("mt-1 text-lg font-semibold flex items-center")}>
                                        {transactionItem.transaction_id}
                                    </div>
                                </div>
                            }
                            <div>
                                <div className="font-medium">Method</div>
                                <div className={cn("mt-1 text-lg font-semibold flex items-center")}>
                                    {transactionItem.transaction_type === "deposit" ? transactionItem.depositMethod?.label : transactionItem.withdrawMethod?.label}
                                </div>
                            </div>
                        </div>
                    </Sidebar>
                    }
                    {/*<Paginator first={first} rows={perPage} totalRecords={transactions.total} rowsPerPageOptions={[15, 30, 50]} onPageChange={onPage} />*/}
                </Card>
            </div >
        </>
    )
}
