import { UserData } from "@/types/_generated";
import { usePage } from "@inertiajs/react";
import { throttle } from "lodash";
import toast from "react-hot-toast";

export default function useUsers() {
    const [users, setUsers] = useState<UserData[]>([]);
    const [loading, setLoading] = useState(false);
    const [searchString, setSearchString] = useState("");
    const search = useCallback(throttle(async (e: any) => {
        setLoading(true);
        setSearchString(e.target.value);
        const response = await fetch(route("search-users", { search: searchString }), {
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
    }, 500, { leading: true, trailing: true }), [searchString]);

    return {
        users,
        loading,
        searchString,
        search,
    }
}
