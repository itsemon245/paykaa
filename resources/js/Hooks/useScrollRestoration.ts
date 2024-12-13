import { storage } from "@/utils";
import { RefObject } from "react";

export default function useScrollRestoration(ref: RefObject<HTMLElement>, key: string) {
    const restore = (position?: number, append: boolean = false) => {
        if (!ref.current) return;
        const oldPos = parseFloat(storage.getItem(key) || "0");
        let newPos = 0;
        if (append && position !== undefined) {
            newPos = oldPos + position;
        } else {
            newPos = position || oldPos;
        }
        console.log("restoring " + key, newPos);
        ref.current.scrollTo({
            top: newPos,
            behavior: 'smooth'
        });
    }
    const scrollToBottom = () => {
        if (!ref.current) return;
        console.log("scrolling to bottom", ref.current.scrollHeight);
        ref.current.scrollTo({
            top: ref.current.scrollHeight,
            behavior: 'smooth'
        });
    };

    const scrollToTop = () => {
        if (!ref.current) return;
        ref.current.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    };
    const currentScroll = () => {
        if (!ref.current) return 0;
        return parseFloat(ref.current.scrollTop.toFixed(2));
    }
    const remember = () => {
        storage.setItem(key, currentScroll().toString());
    };
    useEffect(() => {
        if (!ref.current) return;
        ref.current.addEventListener('scroll', remember);
    }, []);

    return { restore, scrollToBottom, scrollToTop, currentScroll, remember };
}
