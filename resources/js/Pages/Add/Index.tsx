import { PaginatedCollection } from '@/types'
import { AddData, AddMethodData, AddType } from '@/types/_generated'
import { titleCase } from '@/utils'
import { Link, useForm, usePage } from '@inertiajs/react'
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
    const [updateUrl, setUpdateUrl] = useState('')

    const { data, setData, processing, errors, post, patch, reset } = useForm({
        type: "Buy",
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

    const edit = (id?: number) => {
        if (!id) return
        setVisible(true)
        const item = adds.data.find(item => item.id === id)
        if (item) {
            setUpdateUrl(route('add.update', { add: item.uuid }))
            setData('type', item.type)
            setData('add_method_id', item.add_method_id)
            setData('amount', item.amount)
            setData('rate', item.rate)
            setData('limit_max', item.limit_max)
            setData('limit_min', item.limit_min)
            setData('contact', item.contact)
        }
    }


    useEffect(() => {
        console.log(data)
    }, [data])
    const submit = async (e?: React.FormEvent<HTMLFormElement>) => {
        e?.preventDefault()
        const toastId = toast.loading('Publishing add...')
        type FormOptions = Parameters<typeof post>[1];
        const options: FormOptions = {
            onSuccess: (data) => {
                if (data.props.error) {
                    toast.error(data.props.error, {
                        id: toastId
                    })
                    return
                }
                toast.success(`Add ${updateUrl ? "updated" : "published"} successfully!`, {
                    id: toastId
                })
                setVisible(false)
                setAdds(data.props.adds as PaginatedCollection<AddData>)
            },
            onError: (err: any) => {
                console.error("Error while publishing add", err)
                toast.error('Failed to publish add', {
                    id: toastId
                })
            }
        }
        if (updateUrl) {
            patch(updateUrl, options)
        } else {
            post(route('add.store'), options)
        }
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
                    <Dialog onHide={toggleDialog} header={updateUrl ? "Edit Add" : "Post Ad"} footer={<Footer />} visible={visible} className="h-[80vh] md:h-[70vh]">
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
                {adds.data.length !== 0 ? <DataTable className="rounded-lg overflow-hidden" emptyMessage={<div className="text-center font-bold">No adds Yet</div>} dataKey="uuid" totalRecords={adds.total} value={adds.data} rows={perPage} tableStyle={{ minWidth: '50rem' }}>
                    <Column field="id" header="No." body={(item, options) => <div className="font-bold">{options.rowIndex + 1}</div>} style={{ width: 'max-content' }}></Column>
                    <Column field="created_at" body={(item) => format(parseISO(item.created_at), "PP")} header="Date" className="w-[100px]"></Column>
                    <Column field="amount" header="Amount" style={{ width: 'max-content' }}></Column>
                    <Column field="rate" header="Rate" style={{ width: 'max-content' }}></Column>
                    <Column field="limit_min" header="Limits" style={{ width: 'max-content' }} body={(item) => `${item.limit_min ?? '-'} - ${item.limit_max ?? '-'}`}></Column>
                    <Column field="type" header="Type" className="capitalize" body={(item) => titleCase(item.type)} style={{ width: 'max-content' }}></Column>
                    <Column field="addMethod" header="Method" body={(item: AddData) => item.addMethod?.name} style={{ width: 'max-content' }}></Column>
                    <Column field="actions" header="Actions" body={(item: AddData) =>
                        <div className="flex gap-2 items-center">
                            <Button onClick={() => edit(item.id as number)} color="primary" size="small">Edit</Button>
                            <Link href={route('add.destroy', { add: item.uuid })} preserveState={false} only={['adds']} method="delete" as="button" className="p-button p-button-danger">Delete</Link>
                        </div>
                    } style={{ width: 'max-content' }}></Column>

                </DataTable >
                    : <NoItems />
                }
                {/*<Paginator first={first} rows={perPage} totalRecords={adds.total} rowsPerPageOptions={[15, 30, 50]} onPageChange={onPage} />*/}

            </Card >
        </>
    )
}

