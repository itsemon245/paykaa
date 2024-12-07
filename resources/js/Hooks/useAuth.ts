import { UserData } from "@/types/_generated";
import { usePage } from "@inertiajs/react";

export default function useAuth(): {
    user: UserData;
} {
    const auth = usePage().props.auth;
    return auth;
}
