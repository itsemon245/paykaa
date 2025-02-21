export default function NoItems({
    value = 'No items yet',
}) {
    return (
        <div className="heading text-center my-2">
            {value}
        </div>
    )
}
