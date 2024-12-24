import { useState, useEffect } from 'react';

const tailwindBreakpoints = {
    xs: 300,
    sm: 640,
    md: 768,
    lg: 1024,
    xl: 1280,
    '2xl': 1536,
} as const;
export type Breakpoint = keyof typeof tailwindBreakpoints
export type BreakpointWidth = typeof tailwindBreakpoints[Breakpoint]

const getBreakpoint = (width: BreakpointWidth): Breakpoint => {
    if (width >= tailwindBreakpoints['2xl']) return '2xl';
    if (width >= tailwindBreakpoints.xl) return 'xl';
    if (width >= tailwindBreakpoints.lg) return 'lg';
    if (width >= tailwindBreakpoints.md) return 'md';
    if (width >= tailwindBreakpoints.sm) return 'sm';
    return 'xs'; // For screens smaller than 'sm'
};
const getBreakpointWidth = (breakpoint: Breakpoint): BreakpointWidth => {
    return tailwindBreakpoints[breakpoint];
};

export default function useBreakpoint() {
    const [breakpoint, setBreakpoint] = useState(getBreakpoint(window.innerWidth as BreakpointWidth));
    const min = (value: Breakpoint | number): boolean => {
        const compareWidth = typeof value === 'number' ? value : getBreakpointWidth(value);
        return window.innerWidth >= compareWidth;
    };

    const max = (value: Breakpoint | number): boolean => {
        const compareWidth = typeof value === 'number' ? value : getBreakpointWidth(value);
        return window.innerWidth <= compareWidth;
    };

    const between = (start: Breakpoint | number, end: Breakpoint | number): boolean => {
        const startWidth = typeof start === 'number' ? start : getBreakpointWidth(start);
        const endWidth = typeof end === 'number' ? end : getBreakpointWidth(end);
        return window.innerWidth >= startWidth && window.innerWidth <= endWidth;
    };
    useEffect(() => {
        const handleResize = () => {
            setBreakpoint(getBreakpoint(window.innerWidth as BreakpointWidth));
        };

        window.addEventListener('resize', handleResize);
        return () => window.removeEventListener('resize', handleResize);
    }, []);

    return {
        breakpoint,
        min,
        max,
        between
    };
};
