import { classNames } from "primereact/utils";

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
export const poll = (fn: () => void, timeout: number) => {
    console.log("polling", {
        fn,
        timeout,
    });
    const interval = setInterval(fn, timeout);
    return () => clearInterval(interval);
};

export const titleCase = (title: string) => {
    //convert any case (camelCase, PascaleCase, kebab-case, snake_case) to Title Case
    return transform(title, 'title');
};
export function transform(input: string, targetCase: 'camel' | 'snake' | 'pascal' | 'kebab' | 'title'): string {
    // Normalize the input string by splitting it into words
    const words = input
        .replace(/([a-z])([A-Z])/g, '$1 $2') // Handle camelCase and PascalCase
        .replace(/[_-]/g, ' ')              // Handle snake_case and kebab-case
        .toLowerCase()                      // Convert all to lowercase initially
        .split(/\s+/);                     // Split by spaces

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
            throw new Error(`Unsupported case: ${targetCase}`);
    }
}
export const cn = classNames
