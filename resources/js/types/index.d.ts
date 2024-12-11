import { Config } from 'ziggy-js';
import { UserData } from './_generated';

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: UserData;
    };
    ziggy: Config & { location: string };
};
export type PaginatedCollection<T extends object> = {
    data: Array<T>;
    meta: {
        current_page: number;
        first_page_url: string | null;
        from: number;
        last_page: number;
        last_page_url: string | null;
        next_page_url: string | null;
        path: string;
        per_page: string;
        prev_page_url: string | null;
        to: number;
        total: number;
    };
};

