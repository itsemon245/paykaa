import { UserData } from "@/types/_generated";
import { poll } from "@/utils";
import { usePage } from "@inertiajs/react";

export default function useActiveStatus(user?: UserData) {
    const [activeStatus, setActiveStatus] = useState<string | boolean>(false);
    const { csrfToken, impersonating } = usePage().props;

    const updateActiveStatus = async () => {
        if (impersonating?.old) {
            return;
        }
        const response = await fetch(route("active-status.update"), {
            method: "post",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
        });
        if (!response.ok) {
            console.error("something went wrong while updating active status", response);
            return;
        }
    };

    const checkActiveStatus = async (user?: UserData) => {
        if (!user) {
            return;
        }
        const response = await fetch(route("active-status.check", { user: user.uuid }), {
            method: "post",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
        });
        if (!response.ok) {
            console.error("Something went wrong while making users online", response);
            return;
        }
        const data = await response.json();
        console.log("activeStatus", data.active_status)
        setActiveStatus(data.active_status);
    }

    useEffect(() => {
        if (user !== undefined) {
            checkActiveStatus(user);
            return poll(() => checkActiveStatus(user), 19000);
        }
    }, [])
    return {
        activeStatus,
        updateActiveStatus,
    }
}
