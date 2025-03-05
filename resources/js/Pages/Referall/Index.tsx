import { UserData } from "@/types/_generated";
import { cn, titleCase } from "@/utils";
import { usePage } from "@inertiajs/react";
import { parseISO } from "date-fns";
import { format } from "date-fns/fp";
import { Link } from "@inertiajs/react";
import { Button } from "primereact/button";
import { Column } from "primereact/column";
import { DataTable } from "primereact/datatable";
import { Ripple } from "primereact/ripple";
import toast from "react-hot-toast";

export const ReferNav = () => {
    const menuItems = [
        {
            label: "Refer",
            route: "referrals.index",
        },
        {
            label: "Earn",
            route: "earnings.index",
        },
    ]

    return <div className="flex lg:col-span-2 2xl:col-span-1 items-center justify-center gap-1 sm:gap-2 px-1 sm:px-3 mt-3">
        {menuItems.map((item, i) => (
            <Link prefetch href={route(item.route)} as="a">
                <button className={cn("text-center px-2 py-1 sm:px-3 sm:py-1.5 rounded-lg font-semibold max-sm:text-sm", route().current(item.route) ? 'bg-[var(--green-500)]  text-white' : 'text-gray-700')}>
                    {item.label}
                </button>
            </Link>
        ))}
    </div>

}
export default function Referall() {
    const { user } = useAuth();
    const referrals = usePage().props.referrals as UserData[];
    const referLink = route('login', {
        register: true,
        r: user.id
    });
    const copy = () => {
        navigator.clipboard.writeText(referLink);
        toast.success("Copied to clipboard");
    }
    return <>
        <Head title="Referrals" />
        <div className="">
            <ReferNav />
            <div className="font-bold text-gray-800 mb-2 text-lg">Referral Link:</div>
            <div className="flex items-center gap-2 flex-wrap">
                <div className="bg-white border rounded-lg shadow-sm inline-flex items-center gap-2 p-[12px] text-lg font-semibold">{referLink}</div>
                <Button onClick={copy} className="bg-white text-gray-800 border rounded-lg shadow-sm !p-3.5" icon="pi pi-copy" label="Copy" />
            </div>
            <h1 className="heading mt-4 mb-2">Referrals</h1>
            {referrals.length > 0 ? <DataTable className="rounded-lg overflow-hidden" emptyMessage={<div className="text-center font-bold">No referrals</div>} dataKey="id" value={referrals} tableStyle={{ minWidth: 'max-content' }}>
                <Column field="sl" header="No." body={(item, options) => <div className="font-bold">{options.rowIndex + 1}</div>} style={{ width: 'max-content' }}></Column>
                <Column field="id" header="UID" body={(item) => item.id} style={{ width: 'max-content' }}></Column>
                <Column field="name" header="Name" style={{ width: 'max-content' }}></Column>
                <Column field="email" header="Email" style={{ width: 'max-content' }}></Column>
            </DataTable>
                : <NoItems value="No referrals" />}

        </div >
    </>
}
