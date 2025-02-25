export default function NoItems({
    value = 'No items',
}) {
    return (
        <div className="heading text-center my-2">
            {value}
        </div>
    )
}
