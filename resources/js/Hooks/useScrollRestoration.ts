import { storage } from "@/utils";
import { RefObject } from "react";

export default function useScrollRestoration(ref: RefObject<HTMLElement>, key: string) {
    const restore = () => {
        const scrollTop = storage.getItem(key);
        if (scrollTop) {
            console.log(key, scrollTop);
            ref.current!.scrollTop = parseFloat(scrollTop);
        }
    }
    const remember = (e) => {
        if (!ref.current) return;
        const scrollTop = ref.current.scrollTop;
        console.log("scroll position", scrollTop);
        storage.setItem(key, scrollTop.toString());
    };
    useEffect(() => {
        if (!ref.current) return;
        setTimeout(() => {
            restore();
        }, 3000);
        ref.current.addEventListener('scroll', remember);
        // ref.current!.removeEventListener('scroll', remember);
    }, []);
    return restore;
}
