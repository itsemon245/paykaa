export default function Welcome({
}: PageProps<{ laravelVersion: string; phpVersion: string }>) {
    const handleImageError = () => {
        document
            .getElementById('screenshot-container')
            ?.classList.add('!hidden');
        document.getElementById('docs-card')?.classList.add('!row-span-1');
        document
            .getElementById('docs-card-content')
            ?.classList.add('!flex-row');
        document.getElementById('background')?.classList.add('!hidden');
    };
    const [count, setCount] = useState(0)
    return (
        <>
            <Head title="Welcome" />
            <HugeiconsAlertCircle/>
            <button onClick={() => setCount(count + 1)}>Click me</button>
            {count}
        </>
    );
}
