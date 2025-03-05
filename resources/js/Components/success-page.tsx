"use client"

import { useEffect, useState } from "react"
import { CheckCircle } from "lucide-react"
import { defaultAvatar } from "@/utils"
import { UserData, WalletData } from "@/types/_generated"

interface SuccessPageProps {
    transaction: WalletData | null
    recipient: UserData
    amount: string
    onDone: () => void
}

export default function SuccessPage({ transaction, recipient, amount, onDone }: SuccessPageProps) {
    const [animate, setAnimate] = useState(false)

    // Start animation after component mounts
    useEffect(() => {
        const timer = setTimeout(() => {
            setAnimate(true)
        }, 100)

        return () => clearTimeout(timer)
    }, [])

    return (
        <div className="flex flex-col items-center justify-center py-2">
            {/* Animated check mark */}
            <div
                className={`
          flex items-center justify-center
          size-24 rounded-full bg-green-100 mb-4
          transform transition-all duration-700 ease-out
          ${animate ? "scale-100" : "scale-0"}
        `}
            >
                <CheckCircle
                    className={`
            size-16 text-green-500 stroke-[2.5]
            transition-all duration-700 delay-300 ease-out
            ${animate ? "opacity-100 scale-100" : "opacity-0 scale-50"}
          `}
                />
            </div>

            {/* Success message */}
            <div
                className={`
          md:!text-2xl font-bold text-center mb-1
          transition-all duration-500 delay-500
          ${animate ? "opacity-100 translate-y-0" : "opacity-0 translate-y-4"}
        `}
            >
                Transfer Successful!
            </div>

            <p
                className={`
          text-gray-500 text-center mb-6
          transition-all duration-500 delay-700
          ${animate ? "opacity-100 translate-y-0" : "opacity-0 translate-y-4"}
        `}
            >
                You have sent <span className="font-semibold text-primary">{transaction?.amount.toFixed(2)} BDT</span> to{" "}
                {recipient.name}
            </p>

            {/* Transaction details */}
            <div
                className={`
          w-full bg-neutral-100 p-4 rounded-lg mb-4 mt-2
          transition-all duration-500 delay-900
          ${animate ? "opacity-100 translate-y-0" : "opacity-0 translate-y-4"}
        `}
            >
                <div className="flex items-center mb-4">
                    <div className="h-12 w-12 rounded-full overflow-hidden bg-gray-200 mr-3">
                        <img
                            src={recipient.avatar || "/placeholder.svg"}
                            onError={(e) => {
                                //@ts-ignore
                                e.target.src = defaultAvatar
                            }}
                            alt={recipient.name}
                            className="h-full w-full object-cover"
                        />
                    </div>
                    <div>
                        <p className="font-medium">{recipient.name}</p>
                        <p className="text-sm text-gray-500">{recipient.phone}</p>
                    </div>
                </div>

                <div className="border-t border-gray-300 pt-2">
                    <div className="flex justify-between mb-2">
                        <span className="text-gray-500">Amount:</span>
                        <span className="font-medium">{transaction?.amount.toFixed(2)}BDT</span>
                    </div>
                    <div className="flex justify-between mb-2">
                        <span className="text-gray-500">Date:</span>
                        <span className="font-medium">{new Date().toLocaleDateString()}</span>
                    </div>
                    <div className="flex justify-between mb-2">
                        <span className="text-gray-500">Time:</span>
                        <span className="font-medium">{new Date().toLocaleTimeString()}</span>
                    </div>
                    <div className="flex justify-between pt-2 border-t border-gray-300">
                        <span className="text-gray-700 font-medium">Transaction ID:</span>
                        <span className="font-medium text-gray-500">
                            #{transaction?.transaction_id}
                        </span>
                    </div>
                </div>
            </div>

        </div>
    )
}

