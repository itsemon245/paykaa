import { cn, copyToClipboard } from "@/utils";

export default function UID({ uid, className, labelClass, iconClass }: { uid: number, className?: string, labelClass?: string, iconClass?: string }) {
    return (
        <div className={cn("flex gap-2 items-center mb-0.5 -mt-1.5", className)}>
            <label className={cn("text-white text-sm font-bold mb-0", labelClass)}> UID: {uid}</label>
            <HugeiconsCopy01 className={cn("text-white w-4 h-4 cursor-pointer", iconClass)} onClick={() => copyToClipboard(uid)} />
        </div>
    )
}
