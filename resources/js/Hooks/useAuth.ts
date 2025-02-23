import { UserData } from "@/types/_generated";
import { usePage } from "@inertiajs/react";

export default function useAuth() {
    const auth = usePage().props.auth;
    return {
        ...auth,
        isAdmin: auth.user?.id === 1,
    };
}
