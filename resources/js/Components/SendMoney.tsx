import { useState } from "react"
import SearchRecipient from "@/Components/search-recipient"
import TransactionForm from "@/Components/transaction-form"
import ConfirmationPage from "@/Components/confirmation-page"
import SuccessPage from "@/Components/success-page"
import type { Recipient } from "@/types"
import { Dialog } from "primereact/dialog"
import { UserData, WalletData } from "@/types/_generated"
import toast from "react-hot-toast"
import { router } from "@inertiajs/react"

export default function SendMoney({ sendMoneyVisible, setSendMoneyVisible }: { sendMoneyVisible: boolean, setSendMoneyVisible: React.Dispatch<React.SetStateAction<boolean>> }) {
    const [step, setStep] = useState<"search" | "form" | "confirm" | "success">("search")
    const [selectedRecipient, setSelectedRecipient] = useState<UserData | null>(null)
    const [amount, setAmount] = useState<string>("")
    const [password, setPassword] = useState<string>("")
    const [transaction, setTransaction] = useState<WalletData | null>(null)

    const handleRecipientSelect = (recipient: UserData) => {
        setSelectedRecipient(recipient)
        setStep("form")
    }

    const handleChangeRecipient = () => {
        setSelectedRecipient(null)
        setStep("search")
    }

    const handleNextStep = () => {
        setStep("confirm")
    }

    const handleSendMoney = (success?: () => void) => {
        if (!selectedRecipient) {
            toast.error("Please select a recipient")
            return;
        }
        router.post(route('send-money.store'), { amount, password, recipient: selectedRecipient?.id }, {
            preserveUrl: true,
            onSuccess: (data) => {
                if (data.props.error) {
                    toast.error(data.props.error)
                    return;
                }
                if (data.props.transaction) {
                    setTransaction(data.props.transaction as WalletData)
                    success?.()
                    setStep("success")
                } else {
                    toast.error("Something went wrong. Try again later.")
                    console.log(data)
                }
            },
            onError: (error) => {
                console.error(error)
                const errors = Object.values(error);
                if (errors.length === 0) {
                    toast.error("Something went wrong. Try again later.")
                    return;
                }
                errors.forEach((error) => {
                    toast.error(error)
                })
            }
        })
    }

    const resetStates = () => {
        // Reset the form and go back to search
        setSelectedRecipient(null)
        setAmount("")
        setPassword("")
        setStep("search")
    }

    return (
        <Dialog pt={{
            header: {
                className: 'p-2'
            },
            content: {
                className: 'p-2'
            }
        }} header={undefined} className="max-w-lg min-h-[420px]" visible={sendMoneyVisible} onHide={() => {
            resetStates()
            setSendMoneyVisible(false)
        }}>
            <div className="w-full max-w-lg">
                <div className="text-normal lg:text-xl font-bold text-center mb-6 text-primary">Send Money</div>

                {step === "search" && <SearchRecipient onSelectRecipient={handleRecipientSelect} />}

                {step === "form" && selectedRecipient && (
                    <TransactionForm
                        recipient={selectedRecipient}
                        amount={amount}
                        setAmount={setAmount}
                        password={password}
                        setPassword={setPassword}
                        onChangeRecipient={handleChangeRecipient}
                        onNext={handleNextStep}
                    />
                )}

                {step === "confirm" && selectedRecipient && (
                    <ConfirmationPage
                        recipient={selectedRecipient}
                        amount={amount}
                        onSendMoney={handleSendMoney}
                        onBack={() => setStep("form")}
                    />
                )}

                {step === "success" && selectedRecipient && (
                    <SuccessPage transaction={transaction} recipient={selectedRecipient} amount={amount} onDone={resetStates} />
                )}
            </div>
        </Dialog>
    )
}

