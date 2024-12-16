import { usePage } from "@inertiajs/react";

export default function useConfig() {
    const config = usePage().props.config;
    return config;
}
