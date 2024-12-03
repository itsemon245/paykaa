import { APIOptions, PrimeReactPTOptions } from "primereact/api";
import Tailwind from "primereact/passthrough/tailwind";

const TailwindPT: PrimeReactPTOptions = {
    ...Tailwind,
}

const PrimeOptions = {
    appendTo: 'self',
    ripple: true,
    unstyled: false,
    // pt: Tailwind
} as Partial<APIOptions> | undefined;

export default PrimeOptions;
