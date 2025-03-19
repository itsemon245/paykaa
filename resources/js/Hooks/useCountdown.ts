import { leadingZero } from "@/lib/utils";
import { MoneyRequestData } from "@/types/_generated";

export default function useCountdown(moneyRequest: MoneyRequestData) {
    const [expired, setExpired] = useState(false)
    const calculateTimeLeft = () => {
        if (moneyRequest.expires_at == null || moneyRequest.accepted_at == null) {
            return { days: moneyRequest.duration?.day ?? 0, hours: moneyRequest.duration?.hour ?? 0, minutes: moneyRequest.duration?.minute ?? 0 }
        }
        const difference = new Date(moneyRequest.expires_at as string).getTime() - new Date().getTime();
        let timeLeft = { days: 0, hours: 0, minutes: 0 };

        if (difference > 0) {
            timeLeft = {
                days: Math.floor(difference / (1000 * 60 * 60 * 24)),
                hours: Math.floor((difference / (1000 * 60 * 60)) % 24),
                minutes: Math.floor((difference / 1000 / 60) % 60),
            };
        }
        return timeLeft;
    };

    const [timeLeft, setTimeLeft] = useState(calculateTimeLeft());
    useEffect(() => {
        const difference = new Date(moneyRequest.expires_at as string).getTime() - new Date().getTime();
        setExpired(difference <= 0)
    }, [timeLeft])

    useEffect(() => {
        if (!moneyRequest.accepted_at) return;

        const timer = setInterval(() => {
            setTimeLeft(calculateTimeLeft());
        }, 60000); // Update every minute

        return () => clearInterval(timer);
    }, [moneyRequest]);

    const deliveryTime = useMemo(() => `${leadingZero(timeLeft.days)}D : ${leadingZero(timeLeft.hours)}H : ${leadingZero(timeLeft.minutes)}M`, [timeLeft]);

    return {
        expired,
        deliveryTime
    }

}
