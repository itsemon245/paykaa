import './style.css'
export default function SquareBg({
    className,
    ...props
}: {
    className?: string
}) {
    const itemsCount = 21;
    return (
        <ul className={`background ${className}`} {...props}>
            {Array.from(Array(itemsCount)).map((_, i) => (
                <li key={i} className=""></li>
            ))}
        </ul>
    )
}

