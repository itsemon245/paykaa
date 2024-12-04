//@ts-nocheck
import { APIOptions, PrimeReactPTOptions } from "primereact/api";
import Tailwind from "primereact/passthrough/tailwind";
import { classNames } from "primereact/utils";
import { twMerge } from "tailwind-merge";
const TRANSITIONS = {
    overlay: {
        enterFromClass: 'opacity-0 scale-75',
        enterActiveClass: 'transition-transform transition-opacity duration-150 ease-in',
        leaveActiveClass: 'transition-opacity duration-150 ease-linear',
        leaveToClass: 'opacity-0'
    }
};

const TailwindPT = {
    ...Tailwind,
    inputtext: {
        root: ({ props, context }) => ({
            className: classNames(
                'm-0 w-full',
                'font-sans text-gray-600 dark:text-white/80 bg-white dark:bg-gray-900 border transition-colors duration-200 appearance-none rounded-lg',
                {
                    'focus:outline-none focus:outline-offset-0 focus:shadow-[var(--primary-200)] dark:focus:shadow-[var(--primary-800)]':
                        !context.disabled,
                    'hover:border-blue-500': !props.invalid && !context.disabled,
                    'opacity-60 select-none pointer-events-none cursor-not-allowed': context.disabled,
                    'border-gray-300 dark:border-blue-900/40': !props.invalid,
                    'border-red-500 hover:border-red-500/80 focus:border-red-500':
                        props.invalid && !context.disabled,
                    'border-red-500/50': props.invalid && context.disabled,
                },
                {
                    'text-lg p-2': props.size === 'large',
                    'text-xs px-2 py-2': props.size === 'small',
                    'p-2 text-base': !props.size || typeof props.size === 'number'
                },
                {
                    'pl-8': context.iconPosition === 'left',
                    'pr-8': props.iconPosition === 'right'
                }
            ),
        }),
    },
    password: {
        root: ({ props }) => ({
            className: classNames('flex w-full *:w-full', {
                'opacity-60 select-none pointer-events-none cursor-not-allowed': props.disabled
            })
        }),
        panel: 'p-5 bg-white dark:bg-gray-900 text-gray-700 dark:text-white/80 shadow-md rounded-md',
        meter: 'mb-2 bg-gray-300 dark:bg-gray-700 h-3',
        meterlabel: ({ state, props }) => ({
            className: classNames(
                'transition-width duration-1000 ease-in-out h-full',
                {
                    'bg-red-500': state.meter?.strength == 'weak',
                    'bg-orange-500': state.meter?.strength == 'medium',
                    'bg-green-500': state.meter?.strength == 'strong'
                },
                { 'pr-[2.5rem] ': props.toggleMask }
            )
        }),
        showicon: {
            className: classNames('absolute top-1/2', 'right-3 text-gray-600 dark:text-white/70')
        },
        hideicon: {
            className: classNames('absolute top-1/2', 'right-3 text-gray-600 dark:text-white/70')
        },
        inputIcon: {
            root: 'mt-0'
        },
        transition: TRANSITIONS.overlay
    }
}

const PrimeOptions = {
    appendTo: 'self',
    ripple: true,
    unstyled: false,
    pt: {
        password: {
            showicon: {
                className: classNames('absolute top-1/2 -mt-2', 'right-3 text-gray-600 dark:text-white/70')
            },
            hideicon: {
                className: classNames('absolute top-1/2 -mt-2', 'right-3 text-gray-600 dark:text-white/70')
            },
        }

    },
    ptOptions: { mergeSections: true, mergeProps: true, classNameMergeFunction: twMerge }
} as Partial<APIOptions> | undefined;

export default PrimeOptions;
