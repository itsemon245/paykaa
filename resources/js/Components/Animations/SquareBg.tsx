import { CSSProperties } from 'react';
import { motion } from "motion/react"
export default function SquareBg({
    className,
    animate,
    ...props
}: {
    className?: string,
    animate?: boolean
}) {
    const itemsCount = 21;
    const between = (min: number, max: number, weight = 50): number => {
        // Clamp weight between 0 and 100
        weight = Math.max(0, Math.min(weight, 100));

        // Normalize weight to a range between 0 and 1
        const normalizedWeight = weight / 100;

        // Generate a random number between 0 and 1
        const random = Math.random();

        // Skew the random number using the weight
        const skewedRandom = Math.pow(random, 1 / normalizedWeight);

        // Map the skewed random number to the min-max range
        return Math.floor(min + skewedRandom * (max - min));
    };
    const square = ({
        key,
        ...props
    }: { key: any }): JSX.Element => {
        const size = between(65, 215, 45);
        const left = between(10, 90);
        const rotate = between(780, 1200);
        const duration = between(12, 30, size > 100 ? 100 : 20);
        const delay = between(1, 7, 80);
        const radius = 10;
        const styles: CSSProperties = {
            left: `${left}dvw`,
            width: `${size}px`,
            height: `${size}px`,
            bottom: `-${size}px`,
            position: 'absolute',
            display: 'block',
            borderRadius: `${radius}px`,
            border: `2px solid var(--primary-400)`,
            backgroundColor: `var(--primary-500)`,
        }
        return <motion.li key={key} style={styles} transition={{
            duration: duration,
            ease: "linear",
            repeat: Infinity,
            repeatDelay: delay
        }}
            animate={{
                rotate: rotate,
                translateY: -1000,
                opacity: between(0.3, 0.6),
                borderRadius: radius + '%',
            }} {...props} />
    }
    return (
        <div className={`fixed z-[-1] bg-primary-gradient overflow-hidden ${className}`} >
            <ul {...props}>
                {animate && Array.from(Array(itemsCount)).map((_, i) => square({ key: "square-" + i }))}
            </ul>
        </div>
    )
}

