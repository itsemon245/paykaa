import { cn } from "@/utils";

export default function Logo({
    className,
    variant = "long",
    ...props
}: {
    className?: string
    variant?: "long" | "short" | "icon"
}) {
    const config = useConfig();
    const getSrc = (variant?: "long" | "short" | "icon") => {
        switch (variant) {
            case "long":
                return "/assets/logo-long.png";
            case "short":
                return "/assets/logo-short.png";
            case "icon":
                return "/assets/favicon.png";
            default:
                return "/assets/logo-long.png";
        }
    }
    return <>
        <img src={getSrc(variant)} alt={config.app.name + "Logo"} className={cn("w-full max-w-[200px]", className)} {...props} />
    </>
}
