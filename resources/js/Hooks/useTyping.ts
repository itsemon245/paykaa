import { ChatData } from "@/types/_generated";
import { throttle } from "lodash";
import toast from "react-hot-toast";

export default function useTyping(chat?: ChatData) {
    const [isTyping, setIsTyping] = useState(false);
    const toggleTyping = useCallback(
        throttle(async (is_typing: boolean) => {
            //return early to disable for now
            return;
            if (!chat) {
                return;
            }
            const url = route('chat.typing', { chat: chat.uuid, is_typing: is_typing });
            const res = await fetch(url)
            if (!res.ok) {
                console.error('Error while toggling typing', res);
            }
        }, 2000, { trailing: false, leading: true })
        , []
    );


    const handleBlurOrBeforeUnload = async () => {
        if (chat) {
            if (chat.is_typing) {
                toggleTyping(false);
            }
        }
    };
    // useEffect(() => {
    //     // Attach event listeners
    //     window.addEventListener("blur", handleBlurOrBeforeUnload);
    //     window.addEventListener("beforeunload", handleBlurOrBeforeUnload);
    //
    //     // Cleanup event listeners on component unmount
    //     return () => {
    //         window.removeEventListener("blur", handleBlurOrBeforeUnload);
    //         window.removeEventListener("beforeunload", handleBlurOrBeforeUnload);
    //     };
    // }, []);
    return {
        toggleTyping,
        isTyping,
        setIsTyping,
    }
}
