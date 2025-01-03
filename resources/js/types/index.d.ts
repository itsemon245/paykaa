import { Config } from 'ziggy-js';
import { UserData } from './_generated';

export type ButtonSeverity = "contrast" | "secondary" | "success" | "info" | "warning" | "danger" | "help" | undefined;
export interface ServerAppConfig {
    name: string;
    env: string;
    payment: {
        charge: number;
        is_fixed_amount: boolean;
    }
}
export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: UserData;
    };
    ziggy: Config & { location: string };
    error?: string,
    success?: string,
    config: {
        app: ServerAppConfig
    },
    options?: {
        hideSidebar?: boolean
    },
    paths: {
        resources: string,
        public: string,
        storage: string,
        base: string,
    }
};
export type PaginatedCollection<T extends object> = {
    data: Array<T>;
    current_page: number;
    first_page_url: string | null;
    from: number;
    last_page: number;
    last_page_url: string | null;
    next_page_url: string | null;
    path: string;
    per_page: number;
    prev_page_url: string | null;
    to: number;
    total: number;
};

