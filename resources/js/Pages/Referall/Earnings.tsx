import { EarningData } from "@/types/_generated";
import { cn } from "@/utils";
import { Link, useForm, usePage } from "@inertiajs/react";
import { format, parseISO } from "date-fns";
import { Button } from "primereact/button";
import { Column } from "primereact/column";
import { DataTable } from "primereact/datatable";
import { Tag } from "primereact/tag";
import toast from "react-hot-toast";
import { ReferNav } from "./Index";

interface EarningGroup {
    from_id: number,
    items: EarningData[]
}
export default function Earnings() {
    const earnings = usePage().props.earnings as EarningData[];
    const { min_earnable_amount } = usePage().props.settings.transactions;
    const minEarnableAmount = parseInt(min_earnable_amount);
    const grouppedEarnings = [] as EarningGroup[];
    const getEarnings = (group: EarningGroup) => {
        const earning = group.items.reduce((acc, item) => acc + item.amount, 0);
        return earning > minEarnableAmount ? minEarnableAmount : earning;
    }
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
        const earnings = group.items.reduce((acc, item) => acc + item.amount, 0)
        return (
            <div className="flex gap-2 items-center">
                {minEarnableAmount > earnings &&
                    <div>Need <span className="font-semibold">{minEarnableAmount} BDT </span></div>
                }
                {group.items[0]?.status !== 'converted' ? <Button
                    pt={{
                        label: {
                            className: 'max-sm:text-sm'
                        }
                    }}
                    label="Transfer" className="p-button-success !w-max max-sm:px-1.5 max-sm:py-1" disabled={minEarnableAmount > earnings} onClick={() => convertEarnings(group.from_id)} /> : <Tag value="Completed" severity='success' />}
            </div>
        )

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
            <ReferNav />
            <div className="flex items-center justify-between">
                <h1 className="heading">Earnings</h1>
            </div>
            {grouppedEarnings.length > 0 ? <DataTable className="rounded-lg overflow-hidden max-sm:text-sm" emptyMessage={<div className="text-center font-bold">No earnings</div>} dataKey="id" value={grouppedEarnings} tableStyle={{ minWidth: 'max-content' }}>
                <Column field="sl" header="No." body={(group: EarningGroup, options) => <div className="font-bold">{options.rowIndex + 1}</div>} style={{ width: 'max-content' }}></Column>
                <Column field="from" header="From" body={(group: EarningGroup) => group.from_id} style={{ width: 'max-content' }}></Column>
                <Column field="items" header="Earnings" body={(group: EarningGroup) => <span>{getEarnings(group)} BDT</span>} style={{ width: 'max-content' }}></Column>
                <Column field="actions" header="Actions" body={action} />
            </DataTable >
                : <NoItems value="No earnings" />}

        </>
    );
}
