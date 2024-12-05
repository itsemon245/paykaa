import { usePage } from "@inertiajs/react";

interface Config {
    app: {
        name: string;
        env: string;
    }
}
export default function useConfig(): Config {
    const config = usePage().props.config as Config;
    return config;
}
