import { PaginatedCollection } from "@/types";
import { WalletData } from "@/types/_generated";
import { titleCase } from "@/utils";
import { router, usePage } from "@inertiajs/react";
import { format, parseISO } from "date-fns";
import { Card } from "primereact/card";
import { Column, ColumnBodyOptions } from "primereact/column";
import { DataTable, DataTableStateEvent } from "primereact/datatable";
import { Paginator, PaginatorPageChangeEvent } from "primereact/paginator";
import { Tag, TagProps } from "primereact/tag";

export default function Transactions() {
    const pageProps = usePage().props
    const initialTransactions = pageProps.transactions as PaginatedCollection<WalletData>
    const [transactions, setTransactions] = useState(initialTransactions)
    const [perPage, setPerPage] = useState(transactions.per_page)
    const [first, setFirst] = useState(0);

    const getSenderNumber = (item: WalletData) => {
        if (item.transaction_type === "deposit") {
            return item.payment_number
        }
        if (item.transaction_type === "withdraw") {
            return item.depositMethod?.number
        }
        if (item.transaction_type === "transfer_in") {
            return "uid"
        }
        if (item.transaction_type === "transfer_out") {
            return "uid"
        }
        return item.payment_number
    }
    const getReceiverNumber = (item: WalletData) => {
        if (item.transaction_type === "deposit") {
            return "Admin"
        }
        if (item.transaction_type === "withdraw") {
            return item.payment_number
        }
        if (item.transaction_type === "transfer_in") {
            return "uid"
        }
        if (item.transaction_type === "transfer_out") {
            return "uid"
        }
        return ""
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
            "transfer_in": "info",
            "transfer_out": "danger",
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
                    <h1 className="text-xl font-bold mb-3">Transactions</h1>
                    <DataTable className="rounded-lg overflow-hidden" emptyMessage={<div className="text-center font-bold">No Transactions Yet</div>} dataKey="uuid" totalRecords={transactions.total} value={transactions.data} rows={perPage} tableStyle={{ minWidth: '50rem' }}>
                        <Column field="id" className="!p-1" header="No." body={slBodyTemplate} style={{ width: 'max-content' }}></Column>
                        <Column field="created_at" body={(item) => format(parseISO(item.created_at), "PPp")} header="Date" className="!p-1 !w-[200px]"></Column>
                        <Column className="!p-1" field="amount" header="Amount" body={amountBodyTemplate} style={{ width: 'max-content' }}></Column>
                        <Column className="!p-1 capitalize" field="transaction_type" header="Type" body={item => item.transaction_type} style={{ width: 'max-content' }}></Column>
                        <Column className="!p-1" field="payment_number" header="Payment Details" style={{ width: 'max-content' }} body={(item: WalletData) => (
                            <div className="flex flex-col gap-2">
                                <div className="flex items-center gap-2">
                                    <div className="text-sm font-bold">Sender:</div>
                                    <div className="text-sm font-bold">{
                                        getSenderNumber(item)
                                    }</div>
                                </div>
                                <div className="flex items-center gap-2">
                                    <div className="text-sm font-bold">Receiver:</div>
                                    <div className="text-sm font-bold">{getReceiverNumber(item)}</div>
                                </div>
                                <div className="flex items-center gap-2">
                                    <div className="text-sm font-bold">Method:</div>
                                    <div className="text-sm font-bold">{item.transaction_type === "deposit" ? item.depositMethod?.label : item.withdrawMethod?.label}</div>
                                </div>
                            </div>
                        )}></Column>
                        {/*
                        <Column className="!p-1 capitalize" field="method" header="Method" style={{ width: 'max-content' }}></Column>
                        <Column className="!p-1" field="payment_number" header="Payment Number" style={{ width: 'max-content' }}></Column>
                        <Column className="!p-1" field="transaction_id" header="Transaction ID" style={{ width: 'max-content' }}></Column>
                        */}
                        <Column className="!p-1" field="approved_at" body={statusBodyTemplate} header="Status" style={{ width: 'max-content' }}></Column>
                    </DataTable>
                    {/*<Paginator first={first} rows={perPage} totalRecords={transactions.total} rowsPerPageOptions={[15, 30, 50]} onPageChange={onPage} />*/}

                </Card>
            </div>

        </>
    )
}
