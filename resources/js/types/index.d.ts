import { Config } from 'ziggy-js';
import { UserData } from './_generated';
import { RouteParams } from './param';


export type RouteName = keyof RouteParams;
export type ButtonSeverity = "contrast" | "secondary" | "success" | "info" | "warning" | "danger" | "help" | undefined;
export interface Settings {
    transactions: {
        base_commission: string;
        min_withdraw_amount: string;
        min_deposit_amount: string;
        referral_commission: string;
        min_earnable_amount: string;
    };
    general: object;
}
export interface ServerAppConfig {
    name: string;
    url: string;
    env: string;
    payment: {
        charge: number;
        is_fixed_amount: boolean;
    }
}
export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    settings: Settings;
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
    },
    impersonating?: {
        current: string,
        old: string,
        backUrl: string
    },
    csrfToken: string,
    unreadCount: number,
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

