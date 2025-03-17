import { leadingZero } from '@/lib/utils';
import { MoneyRequestData } from '@/types/_generated';
import React, { useState, useEffect } from 'react';

interface CountdownProps {
    moneyRequest: MoneyRequestData;
}

const Countdown: React.FC<CountdownProps> = ({ moneyRequest }) => {
    if (moneyRequest.cancelled_at || moneyRequest.rejected_at || moneyRequest.released_at) {
        return
    }
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
        console.log("updated money request", moneyRequest)
        if (!moneyRequest.accepted_at) return;

        const timer = setInterval(() => {
            setTimeLeft(calculateTimeLeft());
        }, 60000); // Update every minute

        return () => clearInterval(timer);
    }, [moneyRequest]);

    const deliveryTime = useMemo(() => `${leadingZero(timeLeft.days)}D : ${leadingZero(timeLeft.hours)}H : ${leadingZero(timeLeft.minutes)}M`, [timeLeft]);

    return (
        <div className='font-medium text-xs text-red-500 text-center'>
            Time Limit➠ {deliveryTime}
        </div>
    );
};

export default Countdown;
