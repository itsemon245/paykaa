import { ChatData } from "@/types/_generated";
import { throttle } from "lodash";

export default function useTyping(chat?: ChatData) {
    const [isTyping, setIsTyping] = useState(false);
    const toggleTyping = throttle(async (is_typing: boolean) => {
        if (!chat) {
            return;
        }
        const url = route('chat.typing', { chat: chat.uuid, is_typing: is_typing });
        const res = await fetch(url)
        if (!res.ok) {
            console.error('Error while toggling typing', res);
        }
    }, 1000)


    const handleBlurOrBeforeUnload = async () => {
        toggleTyping(false);
    };
    useEffect(() => {
        // Attach event listeners
        window.addEventListener("blur", handleBlurOrBeforeUnload);
        window.addEventListener("beforeunload", handleBlurOrBeforeUnload);

        // Cleanup event listeners on component unmount
        return () => {
            window.removeEventListener("blur", handleBlurOrBeforeUnload);
            window.removeEventListener("beforeunload", handleBlurOrBeforeUnload);
        };
    }, []);
    return {
        toggleTyping,
        isTyping,
        setIsTyping,
    }
}
