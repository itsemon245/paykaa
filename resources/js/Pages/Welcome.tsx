export default function Welcome() {
    const [count, setCount] = useState(0)
    return (
        <>
            <Head title="Welcome" />
            <HugeiconsAlertCircle />
            <button onClick={() => setCount(count + 1)}>Click me</button>
            {count}
        </>
    );
}
