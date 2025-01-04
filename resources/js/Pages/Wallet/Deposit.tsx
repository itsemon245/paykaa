import useBreakpoint from "@/Hooks/useBrakpoints";
import { PaginatedCollection } from "@/types";
import { DepositMethodData, WalletData, WalletType } from "@/types/_generated";
import { cn, titleCase } from "@/utils";
import { router, useForm, usePage } from "@inertiajs/react";
import { Button } from "primereact/button";
import { Card } from "primereact/card";
import { Column, ColumnBodyOptions } from "primereact/column";
import { DataTable, DataTableStateEvent } from "primereact/datatable";
import { Dialog } from "primereact/dialog";
import { Tag, TagProps } from "primereact/tag";
import { ReactNode } from "react";
import toast from "react-hot-toast";

interface DepositMethod {
    name: string,
    logo: string,
    label: string,
    component?: ReactNode,
    qr_code?: string,
    account_type?: "Personal" | "Merchant",
    number?: string,
    type: "manual" | "auto",
    category: string
}
interface Page {
    first: number,
    rows: number,
    sortField?: null | string,
    sortOrder?: null | string,
    multiSortMeta?: Array<any> | null,
    filters?: Array<any> | null,
    page: number,
    totalPages: number
}
export default function Deposit() {
    const pageProps = usePage().props
    const { min } = useBreakpoint()
    const initialDeposits = pageProps.deposits as PaginatedCollection<WalletData>
    const depositMethods = pageProps.depositMethods as DepositMethodData[]
    const [deposits, setDeposits] = useState(initialDeposits)
    const [perPage, setPerPage] = useState(deposits.per_page)
    const { data, setData, setError, post, errors, processing } = useForm<Partial<WalletData>>({
        payment_number: "",
        amount: 200,
        transaction_id: "",
        method: "",
        note: "",
        transaction_type: "deposit",
        currency: "bdt",
        type: "credit"
    })
    //group deposit methods by category
    const mappedDepositMethods = depositMethods.reduce((acc, method) => {
        const existing = acc.find(item => item.category === method.category);
        if (existing) {
            existing.methods.push(method);
        } else {
            acc.push({
                category: method.category,
                methods: [method]
            })
        }
        return acc;
    }, [] as { category: string, methods: DepositMethodData[] }[])
    const [activeDepositMethod, setActiveDepositMethod] = useState<DepositMethodData | undefined>();
    const dialogOpened = useMemo(() => activeDepositMethod !== undefined, [activeDepositMethod]);


    const onPage = async (e: DataTableStateEvent) => {
        if (e.page == deposits.current_page && e.rows == deposits.per_page) {
            return
        }
        const url = route('wallet.deposit.index', {
            page: e.page,
            per_page: e.rows,
        })
        router.visit(url, { replace: true, preserveScroll: true })
    }

    const deposit = async (e: React.FormEvent<HTMLFormElement> | React.MouseEvent<HTMLButtonElement>) => {
        const toastId = toast.loading('Depositing...')
        const url = route('wallet.deposit.store')
        post(url, {
            onSuccess: (data) => {
                toast.success('Deposit successful')
                setActiveDepositMethod(undefined)
                setDeposits(data.props.deposits as PaginatedCollection<WalletData>)
            },
            onError: (err) => {
                console.error("Error while depositing", err)
                toast.error('Deposit Failed')
            },
            onFinish: () => {
                toast.dismiss(toastId)
            }
        })
    }
    useEffect(() => {
        if (activeDepositMethod) {
            setData('method', activeDepositMethod?.label)
            setData('type', "credit")
            setData('transaction_type', "deposit")
        }
    }, [JSON.stringify(activeDepositMethod)])

    useEffect(() => {
        console.log(deposits)
    }, [deposits])

    const slBodyTemplate = (item: WalletData, options: ColumnBodyOptions) => {
        return <div className="font-bold">{options.rowIndex + 1}</div>
    }
    const getSeverity = (status: WalletData['status']): TagProps['severity'] => {
        switch (status) {
            case "approved":
                return "success";
            case "failed":
                return "danger";
            case "cancelled":
                return "contrast";
            case "pending":
                return "warning"
            default:
                return "info";
        }
    }
    const StatusBodyTemplate = (item: WalletData) => {
        return <Tag value={item.status[0].toUpperCase() + item.status.slice(1)} severity={getSeverity(item.status)}></Tag>;
    };
    const amountBodyTemplate = (item: WalletData) => {
        return <div className="font-bold">{item.amount.toLocaleString('en-IN', { style: 'currency', currency: 'BDT' })}</div>
    }
    const DepositFooter = () => {
        return (
            <div className="flex justify-end md:flex-row-reverse gap-2">
                <Button outlined label="Cancel" onClick={() => setActiveDepositMethod(undefined)} />
                <Button label="Deposit" onClick={deposit} loading={processing} />
            </div>
        )
    }
    return (
        <>
            <Head title="Deposit" />
            <div className="container">
                <Dialog header={`Deposit using ${activeDepositMethod?.label}`} footer={<DepositFooter />} visible={dialogOpened} className="w-[95%] sm:w-[70vw] md:w-[50vw]" onHide={() => setActiveDepositMethod(undefined)}>
                    <form onSubmit={e => {
                        e.preventDefault()
                        deposit(e)
                    }}>
                        <div className="flex flex-col justify-center items-center w-full my-2 gap-3">

                            {activeDepositMethod?.category === "Cryptocurrency" ? <img src={`/storage/${activeDepositMethod?.metadata![0]?.qr_code}`} className="w-32 md:w-40 p-3 border rounded-lg" /> : <img src={`/storage/${activeDepositMethod?.logo}`} className="w-32 md:w-40  p-3 border rounded-lg" />}
                            {activeDepositMethod?.category === 'Cryptocurrency' && <div className="text-xs md:text-sm font-medium text-center">Scan the QR code to send money to this address and fill the form below</div>}
                            {activeDepositMethod?.category === 'Mobile Banking' && <div className="text-xs md:text-sm font-medium text-center">Send money to this number and fill the form below</div>}
                            {activeDepositMethod?.category === 'Bank' && <div className="text-xs md:text-sm font-medium text-center">Send money to this account and fill the form below</div>}
                            {activeDepositMethod?.category === 'Bank' ? (
                                <div className="grid md:grid-cols-2 gap-y-3 gap-x-7 items-center justify-center">
                                    <div className="flex gap-1">
                                        <div className="flex gap-1 font-semibold">
                                            <div>Bank Name</div> <div>:</div>
                                        </div>
                                        <div className="font-medium">{activeDepositMethod?.label}</div>
                                    </div>
                                    <div className="flex gap-1">
                                        <div className="flex gap-1 font-semibold">
                                            <div>Branch Name</div> <div>:</div>
                                        </div>
                                        <div className="font-medium">{activeDepositMethod?.branch_name}</div>
                                    </div>
                                    <div className="flex gap-1">
                                        <div className="flex gap-1 font-semibold">
                                            <div>Account Number</div> <div>:</div>
                                        </div>
                                        <div className="font-medium">{activeDepositMethod?.number}</div>
                                    </div>
                                    <div className="flex gap-1">
                                        <div className="flex gap-1 font-semibold">
                                            <div>Account Holder Name</div> <div>:</div>
                                        </div>
                                        <div className="font-medium">{activeDepositMethod?.account_holder}</div>
                                    </div>
                                    <div className="flex gap-1">
                                        <div className="flex gap-1 font-semibold">
                                            <div>Swift Code</div> <div>:</div>
                                        </div>
                                        <div className="font-medium">{activeDepositMethod?.swift_code}</div>
                                    </div>
                                    <div className="flex gap-1">
                                        <div className="flex gap-1 font-semibold">
                                            <div>Routing Number</div> <div>:</div>
                                        </div>
                                        <div className="font-medium">{activeDepositMethod?.routing_number}</div>
                                    </div>

                                </div>
                            ) : (
                                <div className="text-center md:text-xl font-bold">
                                    <div>
                                        {activeDepositMethod?.category === 'Cryptocurrency' && 'Address: '}
                                        {activeDepositMethod?.category === 'Mobile Banking' && titleCase(activeDepositMethod?.mode || '') + ' Number: '}
                                        {activeDepositMethod?.number}
                                    </div>

                                </div>
                            )}
                        </div>
                        {activeDepositMethod?.mode !== "payment" && (
                            <ManualMobileBanking depositMethod={activeDepositMethod} errors={errors} data={data} setData={setData} />
                        )}
                    </form>
                </Dialog>
                <div className="flex flex-col gap-6 w-full my-6 px-2">
                    {mappedDepositMethods.map((item) => (
                        <div className="" key={item.category}>
                            <h1 className="md:text-xl font-bold mb-3 text-gray-800">{item.category}</h1>
                            <div className="flex max-sm:flex-col items-center flex-wrap gap-2 sm:gap-3 w-full">
                                {item.methods.map((method, index) => {
                                    return (
                                        <Card className={cn("border transition-all cursor-pointer max-sm:w-full", min("md") && 'hover:scale-105')} key={index} onClick={e => setActiveDepositMethod(method)} role="button">
                                            <div className="flex w-full gap-5 items-center justify-start">
                                                <img src={`/storage/${method.logo}`} className="h-12 w-auto sm:w-32" alt={method.label} />
                                                <div className="text-center text-sm sm:text-base font-bold sm:hidden">
                                                    {method.label}
                                                </div>
                                            </div>
                                        </Card>
                                    )
                                })}
                            </div>
                        </div>
                    ))}
                    {/*
                      <Card>
                        <h1 className="text-xl font-bold mb-3">Recent Deposits</h1>
                        <DataTable onPage={onPage} emptyMessage="No Deposits Yet. Approved deposits will be listed in transaction history." dataKey="uuid" pageLinkSize={5} totalRecords={deposits.total} value={deposits.data} rows={perPage} rowsPerPageOptions={[15, 30, 50, 100]} tableStyle={{ minWidth: '50rem' }}>
                            <Column field="id" header="No." body={slBodyTemplate} style={{ width: 'max-content' }}></Column>
                            <Column field="created_at_human" header="Date" style={{ width: '25%' }}></Column>
                            <Column field="amount" header="Amount" body={amountBodyTemplate} style={{ width: '25%' }}></Column>
                            <Column field="transaction_id" header="Transaction ID" style={{ width: '25%' }}></Column>
                            <Column field="payment_number" header="Payment Number" style={{ width: '25%' }}></Column>
                            <Column field="approved_at" body={StatusBodyTemplate} header="Status" style={{ width: '25%' }}></Column>
                        </DataTable>
                    </Card>
                    */}
                </div>
            </div >
        </>
    );
}
