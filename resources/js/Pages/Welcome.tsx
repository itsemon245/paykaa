import { Button } from 'primereact/button';
export default function Welcome() {
    const [count, setCount] = useState(0)
    return (
        <>
            <Head title="Welcome" />
            <HugeiconsAlertCircle />
            <Button size='small' label="Hello" raised />
            <button onClick={() => setCount(count + 1)}>Click me</button>
            {count}
        </>
    );
}
