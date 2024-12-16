import { PaginatedCollection } from "@/types";
import { WalletData, WalletType } from "@/types/_generated";
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
    logo: string | ReactNode,
    label: string,
    component?: ReactNode,
    type: "manual" | "auto"
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
    const initialDeposits = pageProps.deposits as PaginatedCollection<WalletData>
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
    const depositMethods: DepositMethod[] = [
        {
            name: "bkash",
            logo: "/assets/logos/bkash.svg",
            label: "Bkash",
            type: "manual"
        }
    ]
    const [activeDepositMethod, setActiveDepositMethod] = useState<DepositMethod | undefined>();
    const dialogOpened = useMemo(() => activeDepositMethod !== undefined, [activeDepositMethod]);
    const slBodyTemplate = (item: WalletData, options: ColumnBodyOptions) => {
        return <div className="font-bold">{options.rowIndex + 1}</div>
    }

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

                toast.error('Deposit Failed')
            },
            onFinish: () => {
                toast.dismiss(toastId)
            }
        })
    }
    useEffect(() => {
        if (activeDepositMethod) {
            setData('method', activeDepositMethod?.name)
            console.log(activeDepositMethod?.name)
        }
    }, [JSON.stringify(activeDepositMethod)])

    useEffect(() => {
        console.log(deposits)
    }, [deposits])

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
            <Navbar />

            <div className="container">
                <Dialog header="Deposit" footer={<DepositFooter />} visible={dialogOpened} className="w-[95%] sm:w-[70vw] md:w-[50vw]" onHide={() => setActiveDepositMethod(undefined)}>
                    <form onSubmit={e => {
                        e.preventDefault()
                        deposit(e)
                    }}>
                        {activeDepositMethod?.type == "auto" && activeDepositMethod?.component}
                        {activeDepositMethod?.type == "manual" && (
                            <ManualMobileBanking errors={errors} data={data} setData={setData} />
                        )}
                    </form>
                </Dialog>
                <div className="flex flex-col gap-6 w-full my-6">
                    <Card className="mt-6">
                        <h1 className="text-xl font-bold mb-3">Choose a deposit method</h1>
                        {depositMethods.map((method, index) => {
                            return (
                                <Card key={index} onClick={e => setActiveDepositMethod(method)} role="button" className="border hover:scale-105 transition-all cursor-pointer flex flex-col w-max gap-1 items-center justify-center">
                                    <div>
                                        {typeof method.logo === "string" ? <img src={method.logo} className="w-32" /> : method.logo}
                                    </div>
                                </Card>
                            )
                        })}
                    </Card>
                    <Card>
                        <h1 className="text-xl font-bold mb-3">Recent Deposits</h1>
                        <DataTable onPage={onPage} emptyMessage="No Deposits Yet" dataKey="uuid" pageLinkSize={5} totalRecords={deposits.total} value={deposits.data} rows={perPage} rowsPerPageOptions={[15, 30, 50, 100]} tableStyle={{ minWidth: '50rem' }}>
                            <Column field="id" header="No." body={slBodyTemplate} style={{ width: 'max-content' }}></Column>
                            <Column field="created_at_human" header="Date" style={{ width: '25%' }}></Column>
                            <Column field="amount" header="Amount" body={amountBodyTemplate} style={{ width: '25%' }}></Column>
                            <Column field="transaction_id" header="Transaction ID" style={{ width: '25%' }}></Column>
                            <Column field="payment_number" header="Payment Number" style={{ width: '25%' }}></Column>
                            <Column field="approved_at" body={StatusBodyTemplate} header="Status" style={{ width: '25%' }}></Column>
                        </DataTable>
                    </Card>
                </div>
            </div>
        </>
    );
}
