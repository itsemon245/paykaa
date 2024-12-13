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
