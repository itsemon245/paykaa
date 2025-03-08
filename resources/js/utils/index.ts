import { classNames } from "primereact/utils";
import toast from "react-hot-toast";

export const storage = {
    getItem: (key: string) => {
        const item = localStorage.getItem(key);
        console.log("getting from localStorage", {
            key,
            item,
        });
        return item;
    },
    setItem: (key: string, value: string) => {
        console.log("storing in localStorage", {
            key,
            value,
        });
        localStorage.setItem(key, value);
    },
    removeItem: (key: string) => localStorage.removeItem(key),
}
export const cookie = {
    set(key: string, value: string, days?: number): void {
        //set cookie for 1 month by default
        days = days ?? 30;
        const maxAge = days * 24 * 60 * 60;
        document.cookie = `${encodeURIComponent(key)}=${encodeURIComponent(value)}; path=/; Max-Age=${maxAge}; SameSite=Lax`;
    },
    get(key: string): string | null {
        const cookies = document.cookie.split('; ');
        for (const cookie of cookies) {
            const [cookieKey, cookieValue] = cookie.split('=');
            if (decodeURIComponent(cookieKey) === key) {
                return decodeURIComponent(cookieValue);
            }
        }
        return null;
    },
    remove(key: string): void {
        document.cookie = `${encodeURIComponent(key)}=; path=/; expires=Thu, 01 Jan 1970 00:00:00 GMT`;
    }
}
export const poll = (fn: () => void, timeout: number) => {
    console.log("polling function", fn, "dealy", timeout + "ms");
    const interval = setInterval(fn, timeout);
    return () => clearInterval(interval);
};

export const titleCase = (title?: string) => {
    //convert any case (camelCase, PascaleCase, kebab-case, snake_case) to Title Case
    return transform(title, 'title');
};
export function transform(input?: string, targetCase?: 'camel' | 'snake' | 'pascal' | 'kebab' | 'title'): string {
    // Normalize the input string by splitting it into words
    if (!input) {
        return '';
    }
    const words = input
        .replace(/([a-z])([A-Z])/g, '$1 $2') // Handle camelCase and PascalCase
        .replace(/[_-]/g, ' ')              // Handle snake_case and kebab-case
        .toLowerCase()                      // Convert all to lowercase initially
        .split(/\s+/);                     // Split by spaces

    if (!targetCase) {
        targetCase = 'title'
    }

    switch (targetCase) {
        case 'camel':
            return words
                .map((word, index) => index === 0
                    ? word
                    : word.charAt(0).toUpperCase() + word.slice(1))
                .join('');

        case 'snake':
            return words.join('_');

        case 'pascal':
            return words
                .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                .join('');

        case 'kebab':
            return words.join('-');

        case 'title':
            return words
                .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                .join(' ');

        default:
            return input;
    }
}
export const cn = classNames

export const image = (url?: string) => {
    if (!url) {
        return;
    }
    return url.startsWith("http") ? url : `/storage/${url}`;
}

export const getQuery = (param?: string) => {
    if (!param) return '';
    return new URL(window.location.href).searchParams.get(param);
}

export const copyToClipboard = (text?: any) => {
    if (!text) return;
    navigator.clipboard.writeText(text);
    toast.success('Copied to clipboard');
}

export const defaultAvatar = "/assets/images/user.png"

export function removeLeadingSlash(str: string): string {
    return str.replace(/^\/+/, "");
}

export function removeTrailingSlash(str: string): string {
    return str.replace(/\/+$/, "");
}

export function trimSlashes(str: string): string {
    return removeLeadingSlash(removeTrailingSlash(str));
}

export function mask(
    value: string,
    maskChar: string = '*',
    startKeep: number = 0,
    endKeep: number = 0
): string {
    const emailPart = value.split('@')[0];
    if (emailPart.length > 5) {
        endKeep += 3
    }
    if (emailPart.length < 4) {
        startKeep = 1
    }
    // Ensure valid mask character (use first character of the input)
    const effectiveMaskChar = maskChar.length > 0 ? maskChar[0] : '*';

    // Ensure non-negative values for start/end keep
    startKeep = Math.max(startKeep, 0);
    endKeep = Math.max(endKeep, 0);

    const totalVisible = startKeep + endKeep;
    const length = value.length;

    // If there's nothing to mask or keep values exceed string length
    if (totalVisible >= length) {
        return value;
    }

    // Calculate visible portions
    const start = value.slice(0, startKeep);
    const end = endKeep > 0 ? value.slice(-endKeep) : '';
    const maskedLength = length - totalVisible;

    return start + effectiveMaskChar.repeat(maskedLength) + end;
}
