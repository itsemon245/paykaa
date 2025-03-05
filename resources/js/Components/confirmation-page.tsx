"use client"
import { ArrowLeft } from "lucide-react"
import type { Recipient } from "@/types"
import HoldToSendButton from "@/Components/hold-to-send-button"
import { Button } from "primereact/button"
import { defaultAvatar } from "@/utils"
import { UserData } from "@/types/_generated"


interface ConfirmationPageProps {
    recipient: UserData
    amount: string
    onSendMoney: (success?: () => void) => void
    onBack?: () => void
}

export default function ConfirmationPage({ recipient, amount, onSendMoney, onBack }: ConfirmationPageProps) {
    return (
        <div>
            <div className="mb-6">
                <button
                    className="flex items-center gap-1 text-primary mb-4 text-gray-500 hover:text-gray-700"
                    onClick={onBack}
                    type="button"
                >
                    <ArrowLeft className="h-4 w-4 mr-2" />
                    Back
                </button>

                <div className="text-xl font-semibold mb-2 md:mb-3">Confirm Transaction</div>

                <div className="bg-gray-50 p-4 rounded-lg mb-6">
                    <div className="flex items-center mb-4">
                        <div className="h-12 w-12 rounded-full overflow-hidden bg-gray-200 mr-3">
                            <img
                                src={recipient.avatar}
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
                            <p className="text-sm text-gray-500">UID: {recipient.id}</p>
                        </div>
                    </div>

                    <div className="border-t border-gray-200 pt-4">
                        <div className="flex justify-between mb-2">
                            <span className="text-gray-500">Amount:</span>
                            <span className="font-medium">{Number.parseFloat(amount).toFixed(2)} BDT</span>
                        </div>
                        <div className="flex justify-between mb-2">
                            <span className="text-gray-500">Fee:</span>
                            <span className="font-medium">0.00 BDT</span>
                        </div>
                        <div className="flex justify-between pt-2 border-t border-gray-200">
                            <span className="text-gray-700 font-medium">Total:</span>
                            <span className="font-bold text-primary">{Number.parseFloat(amount).toFixed(2)} BDT</span>
                        </div>
                    </div>
                </div>
            </div>

            <HoldToSendButton onComplete={onSendMoney} />
        </div>
    )
}

