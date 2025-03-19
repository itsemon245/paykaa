import { Button } from '@/components/ui/button';
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
    const { deliveryTime } = useCountdown(moneyRequest)

    return (
        <div className='font-medium text-xs text-red-500 text-center'>
            Time Limit➠ {deliveryTime}
        </div>
    );
};

export default Countdown;
