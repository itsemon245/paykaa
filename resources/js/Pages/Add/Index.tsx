import { PaginatedCollection } from '@/types'
import { AddData, AddMethodData, AddType } from '@/types/_generated'
import { titleCase } from '@/utils'
import { useForm, usePage } from '@inertiajs/react'
import { format, parseISO } from 'date-fns'
import { Button } from 'primereact/button'
import { Card } from 'primereact/card'
import { Column } from 'primereact/column'
import { DataTable } from 'primereact/datatable'
import { Dialog } from 'primereact/dialog'
import { Dropdown, DropdownChangeEvent } from 'primereact/dropdown'
import { InputNumber, InputNumberChangeEvent } from 'primereact/inputnumber'
import React, { ChangeEvent } from 'react'
import toast from 'react-hot-toast'

export default function Index() {
    const initialAdds = usePage().props.adds as PaginatedCollection<AddData>
    const addMethods = usePage().props.addMethods as AddMethodData[]
    const { user } = useAuth()
    const [adds, setAdds] = useState(initialAdds)
    const [perPage, setPerPage] = useState(adds.per_page)
    const [visible, setVisible] = useState(false)

    const { data, setData, processing, errors, post, reset } = useForm({
        type: undefined,
        owner_id: user.id,
        add_method_id: undefined,
        amount: 0,
        rate: 0,
        limit_max: undefined,
        limit_min: undefined,
        contact: user.phone
    } as AddData)
    const toggleDialog = () => {
        setVisible(!visible)
        reset()
    }


    useEffect(() => {
        console.log(data)
    }, [data])

    const submit = async (e?: React.FormEvent<HTMLFormElement>) => {
        e?.preventDefault()
        const toastId = toast.loading('Publishing add...')
        post(route('add.store'), {
            onSuccess: (data) => {
                toast.success("Add published successfully!")
                setVisible(false)
                setAdds(data.props.adds as PaginatedCollection<AddData>)
            },
            onError: (err) => {
                console.error("Error while publishing add", err)
                toast.error('Failed to publish add')
            },
            onFinish: () => {
                toast.dismiss(toastId)
            }
        })
    }
    const Footer = () => {
        return (
            <div className="flex justify-end md:flex-row-reverse gap-2">
                <Button outlined label="Cancel" onClick={() => setVisible(false)} />
                <Button label={processing ? "Publishing..." : "Publish"} onClick={e => {
                    submit()
                }} loading={processing} disabled={processing} />
            </div>
        )
    }

    return (
        <>
            <Head title="Ads" />
            <Card className="bg-transparent !shadow-none">
                <div className="flex justify-between items-center mb-3">
                    <h4 className="text-xl font-bold">Ads</h4>
                    <Button onClick={toggleDialog} label='Post Ad' />
                    <Dialog onHide={toggleDialog} header="Post Ad" footer={<Footer />} visible={visible} className="min-h-[50vh]">
                        <form onSubmit={submit}>
                            <div className="grid md:grid-cols-2 gap-4 items-center justify-center">
                                <div className="">
                                    <InputLabel htmlFor="type" value="Type" />
                                    <Dropdown placeholder="Select a type" className="w-full" id='type' options={["Buy", "Sell"]} invalid={errors.type !== undefined} value={data.type} onChange={(e: DropdownChangeEvent) => setData('type', e.target.value as AddType)} />
                                    <InputError message={errors.type} />
                                </div>
                                <div className="">
                                    <InputLabel htmlFor="wallet" value="Wallet" />
                                    <Dropdown placeholder="Select a wallet" className="w-full" invalid={errors.add_method_id !== undefined} id='wallet' options={addMethods.map(item => ({
                                        label: item.name,
                                        value: item.id
                                    }))} value={data.add_method_id} onChange={(e: DropdownChangeEvent) => setData('add_method_id', e.target.value as number)} />
                                    <InputError message={errors.add_method_id} />
                                </div>
                                {data.type && (
                                    <div>
                                        <InputLabel htmlFor="amount" value="Amount" />
                                        <InputNumber className="w-full" placeholder="USD" id='amount' invalid={errors.amount !== undefined} value={data.amount ? data.amount : null} onChange={(e: InputNumberChangeEvent) => setData('amount', e.value as number)} />
                                        <InputError message={errors.amount} />
                                    </div>
                                )}
                                {data.type === 'Sell' && (
                                    <div>
                                        <InputLabel htmlFor="rate" value="Rate" />
                                        <InputNumber className="w-full" id='rate' placeholder='BDT' invalid={errors.rate !== undefined} value={data.rate ? data.rate : null} onChange={(e: InputNumberChangeEvent) => setData('rate', e.value as number)} />
                                        <InputError message={errors.rate} />
                                    </div>
                                )}
                                {data.type === 'Sell' && (
                                    <div>
                                        <InputLabel htmlFor="limit" value="Limit" />
                                        <div className="p-inputgroup flex-1" id='limit'>
                                            <InputNumber className="w-full" placeholder="Min" invalid={errors.limit_min !== undefined} id='limit_min' value={data.limit_min} onChange={(e: InputNumberChangeEvent) => setData('limit_min', e.value as number)} />
                                            <Button tabIndex={-1} className="bg-gray-500" size='small' icon="pi pi-minus" />
                                            <InputNumber className="w-full" placeholder="Max" invalid={errors.limit_max !== undefined} id='limit_max' value={data.limit_max} onChange={(e: InputNumberChangeEvent) => setData('limit_max', e.value as number)} />
                                        </div>
                                    </div>
                                )}
                                {data.type && (
                                    <Input label="Contact" id="contact" error={errors.contact} value={data.contact} onChange={(e: ChangeEvent<HTMLInputElement>) => setData('contact', e.target.value)} />
                                )}
                                {(errors.limit_max || errors.limit_min) &&
                                    <div className="flex gap-3 items-center">
                                        {errors.limit_min && <InputError message={errors.limit_min} />}
                                        {errors.limit_max && <InputError message={errors.limit_max} />}
                                    </div>
                                }
                            </div>
                        </form>
                    </Dialog>
                </div>
                <DataTable className="rounded-lg overflow-hidden" emptyMessage={<div className="text-center font-bold">No adds Yet</div>} dataKey="uuid" totalRecords={adds.total} value={adds.data} rows={perPage} tableStyle={{ minWidth: '50rem' }}>
                    <Column field="id" header="No." body={(item, options) => <div className="font-bold">{options.rowIndex + 1}</div>} style={{ width: 'max-content' }}></Column>
                    <Column field="created_at" body={(item) => format(parseISO(item.created_at), "PP")} header="Date" className="w-[100px]"></Column>
                    <Column field="amount" header="Amount" style={{ width: 'max-content' }}></Column>
                    <Column field="rate" header="Rate" style={{ width: 'max-content' }}></Column>
                    <Column field="limit_min" header="Limits" style={{ width: 'max-content' }} body={(item) => `${item.limit_min ?? '-'} - ${item.limit_max ?? '-'}`}></Column>
                    <Column field="type" header="Type" className="capitalize" body={(item) => titleCase(item.type)} style={{ width: 'max-content' }}></Column>
                    <Column field="addMethod" header="Method" body={(item: AddData) => item.addMethod?.name} style={{ width: 'max-content' }}></Column>

                </DataTable>
                {/*<Paginator first={first} rows={perPage} totalRecords={adds.total} rowsPerPageOptions={[15, 30, 50]} onPageChange={onPage} />*/}

            </Card>
        </>
    )
}

