export default function Preloader() {
    const [loading, setLoading] = useState(true);
    const preloader = useRef<HTMLDivElement>(null);
    useEffect(() => {
        if (preloader.current) {
            setTimeout(() => {
                preloader.current?.remove();
                setLoading(false);
            }, 500);
        }
    }, [preloader.current])

    return (
        <div ref={preloader} className="h-screen w-screen fixed inset-0 flex items-center justify-center z-50 bg-base-gradient overflow-hidden">
            <i className="pi pi-spinner pi-spin text-5xl text-primary" />
        </div>
    )
}

