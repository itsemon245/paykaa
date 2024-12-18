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
    return title.replace(/([a-z])([A-Z])/g, "$1 $2").replace(/([A-Z])([A-Z][a-z])/g, "$1 $2");
};
