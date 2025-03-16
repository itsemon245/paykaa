import useBreakpoint from "@/Hooks/useBrakpoints";
import { ChatData, MessageData } from "@/types/_generated"
import { cn, defaultAvatar, image } from "@/utils";
import { usePage } from "@inertiajs/react";
import { format, parseISO } from "date-fns"
import { Image } from "primereact/image";

export default function ImageMessage({
    message,
}: { message: MessageData }) {
    return (
        <Image pt={{
            image: {
                className: "rounded-lg w-44 md:w-52 max-h-[500px] h-auto object-contain",
            },
            preview: {
                className: "py-4"
            }
        }}
            downloadable
            src={image(message.body as string)}
            alt="Image" preview />
    )
}

