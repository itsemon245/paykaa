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
    const { deliveryTime, remainingTime } = useCountdown(moneyRequest)

    return (
        <>
            {
                moneyRequest.status != 'pending' && moneyRequest.status !== 'waiting for release' && <div className='font-medium text-xs !text-primary-500 text-center'>
                    Time Limit➠ {deliveryTime}
                </div>
            }

            {
                moneyRequest.accepted_at && <div className='font-medium text-xs text-red-500 text-center'>
                    Remaining➠ {remainingTime}
                </div>
            }
        </>
    );
};

export default Countdown;
