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
