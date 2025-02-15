import { EarningData } from "@/types/_generated";
import { useForm, usePage } from "@inertiajs/react";
import { format, parseISO } from "date-fns";
import { Button } from "primereact/button";
import { Column } from "primereact/column";
import { DataTable } from "primereact/datatable";
import { Tag } from "primereact/tag";
import toast from "react-hot-toast";

interface EarningGroup {
    from_id: number,
    items: EarningData[]
}
export default function Earnings() {
    const earnings = usePage().props.earnings as EarningData[];
    const { min_earnable_amount } = usePage().props.settings.transactions;
    const grouppedEarnings = [] as EarningGroup[];
    earnings.forEach((earning) => {
        const earningGroup = grouppedEarnings.find((group) => group.from_id === earning.from_id);
        if (earningGroup) {
            earningGroup.items.push(earning);
        } else {
            grouppedEarnings.push({
                from_id: earning.from_id,
                items: [earning],
            });
        }
    });

    const { data, post, setData, processing } = useForm({})

    const action = (group: EarningGroup) => {
        if (group.items.reduce((acc, item) => acc + item.amount, 0) < parseInt(min_earnable_amount)) {
            return "Not enough earnings";
        }
        return <Button label="Convert" icon="pi pi-exchange" className="p-button-success" onClick={() => convertEarnings(group.from_id)} />
    }
    const convertEarnings = (from_id: number) => {
        const toastId = toast.loading("Converting earnings...");
        post(route('earnings.convert', { from_id }), {
            onSuccess: (data) => {
                if (data.props.error) {
                    toast.error(data.props.error);
                    return;
                }
                toast.success("Converted earnings successfully!", {
                    id: toastId,
                });
            },
            onError: (data) => {
                console.error(data);
                toast.error("Something went wrong!", {
                    id: toastId,
                });
            }
        })
    }
    useEffect(() => {
        console.log(grouppedEarnings);
    }, [earnings]);
    return (
        <>
            <Head title="Earnings" />
            <div className="flex items-center justify-between">
                <h1 className="!text-3xl !font-bold my-3 !text-gray-800">Earnings</h1>
            </div>
            <DataTable className="rounded-lg overflow-hidden" emptyMessage={<div className="text-center font-bold">No earnings Yet</div>} dataKey="id" value={grouppedEarnings} tableStyle={{ minWidth: '50rem' }}>
                <Column field="sl" header="No." body={(group: EarningGroup, options) => <div className="font-bold">{options.rowIndex + 1}</div>} style={{ width: 'max-content' }}></Column>
                <Column field="from" header="From" body={(group: EarningGroup) => group.from_id} style={{ width: 'max-content' }}></Column>
                <Column field="items" header="Earnings" body={(group: EarningGroup) => group.items.reduce((acc, item) => acc + item.amount, 0)} style={{ width: 'max-content' }}></Column>
                <Column field="actions" header="Actions" body={action} />
            </DataTable >

        </>
    );
}
