import { cn } from "@/utils";
import { Link } from "@inertiajs/react";

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
    if (route().current('login')) {
        return <a href="/">
            <img src={getSrc(variant)} alt={config.app.name + "Logo"} className={cn("w-full max-w-[200px]", className)} {...props} />
        </a>
    }
    return <Link href={route('dashboard')}>
        <img src={getSrc(variant)} alt={config.app.name + "Logo"} className={cn("w-full max-w-[200px]", className)} {...props} />
    </Link>
}
