import { clsx, type ClassValue } from "clsx"
import { twMerge } from "tailwind-merge"

export function cn(...inputs: ClassValue[]) {
    return twMerge(clsx(inputs))
}

export function leadingZero(num?: number | string) {
    if (num == undefined) return ''
    return String(num).padStart(2, '0');
}
