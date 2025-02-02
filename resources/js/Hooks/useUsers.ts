import { UserData } from "@/types/_generated";
import { usePage } from "@inertiajs/react";
import { throttle } from "lodash";
import toast from "react-hot-toast";

export default function useUsers() {
    const [users, setUsers] = useState<UserData[]>([]);
    const [loading, setLoading] = useState(false);
    const [searchString, setSearchString] = useState("");
    const search = useCallback(throttle(async (query) => {
        setLoading(true);
        const response = await fetch(route("search-users", { search: query }), {
            method: "get",
            headers: {
                "Content-Type": "application/json",
            },
        })
        if (!response.ok) {
            setLoading(false);
            toast.error("Something went wrong while searching users");
            console.error("Something went wrong while searching users", response);
            return;
        }
        const data = await response.json();
        setUsers(data);
        setLoading(false);
    }, 500, { leading: false, trailing: true }), []);

    useEffect(() => {
        search(searchString);
    }, [searchString]);

    return {
        users,
        loading,
        searchString,
        setSearchString,
        search,
    }
}
