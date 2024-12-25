import { cn } from "@/utils";

export default function Logo({
    className,
    ...props
}: {
    className?: string
}) {
    const config = useConfig();
    return <>
        <img src="/assets/logo-long.png" alt={config.app.name + " Logo"} className={cn("w-full max-w-[200px]", className)} {...props} />
    </>
}
