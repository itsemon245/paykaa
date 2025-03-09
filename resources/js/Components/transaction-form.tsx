import type React from "react"
import { Edit2 } from "lucide-react"
import type { Recipient } from "@/types"
import { Button } from "primereact/button"
import { defaultAvatar, image } from "@/utils"
import { Password } from "primereact/password"
import { UserData } from "@/types/_generated"
import toast from "react-hot-toast"
import { useForm } from "@inertiajs/react"

interface TransactionFormProps {
    recipient: UserData
    amount: string
    setAmount: (amount: string) => void
    password: string
    setPassword: (password: string) => void
    onChangeRecipient: () => void
    onNext: () => void
}

export default function TransactionForm({
    recipient,
    amount,
    setAmount,
    password,
    setPassword,
    onChangeRecipient,
    onNext,
}: TransactionFormProps) {
    const { balance } = useBalance()
    const { post, data, processing, errors, setData } = useForm({
        amount: Number.parseFloat(amount),
        password: password,
    })
    useEffect(() => {
        setData({
            amount: Number.parseFloat(amount),
            password: password,
        })
    }, [amount, password])

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault()
        if (balance < Number.parseFloat(amount)) {
            toast.error("Insufficient balance")
            return;
        }
        if (amount && password) {
            const toastId = toast.loading("Verifying password...")
            post("/send-money-verify-password", {
                preserveUrl: true,
                onSuccess: (data) => {
                    console.log(data)
                    if (data.props.error) {
                        toast.error(data.props.error, { id: toastId })
                        return;
                    }
                    if (data.props.success) {
                        toast.success(data.props.success, { id: toastId })
                        onNext()
                    } else {
                        toast.error("Unable to verify. Please try again later.", { id: toastId })
                        return;
                    }
                },
                onError: (error) => {
                    if (errors.password) {
                        toast.error(errors.password, { id: toastId })
                    }
                    if (errors.amount) {
                        toast.error(errors.amount, { id: toastId })
                    }
                }
            })
        }
    }

    return (
        <form onSubmit={handleSubmit}>
            <div className="flex flex-col items-center mb-3 relative">
                <div className="h-20 w-20 rounded-full overflow-hidden bg-gray-200 mb-1">
                    <img
                        src={image(recipient.avatar)}
                        onError={(e) => {
                            //@ts-ignore
                            e.target.src = defaultAvatar
                        }}
                        alt={recipient.name}
                        className="h-full w-full object-cover"
                    />
                </div>
                <div className="text-lg font-medium">{recipient.name}</div>
                <p className="text-gray-500">UID: {recipient.id}</p>
                <div className="font-bold text-gray-500">Your Balance: {balance} BDT</div>

                <button
                    type="button"
                    onClick={onChangeRecipient}
                    className="absolute right-0 top-0 p-2 text-primary hover:text-primary/80"
                    aria-label="Change recipient"
                >
                    <Edit2 className="h-5 w-5" />
                </button>
            </div>

            <div className="space-y-4">
                <div>
                    <label htmlFor="amount" className="block text-sm font-medium text-gray-700 mb-1">
                        Amount
                    </label>
                    <Input
                        id="amount"
                        type="number"
                        placeholder="Enter amount"
                        value={amount}
                        onChange={(e) => setAmount(e.target.value)}
                        required
                        min="1"
                        className="w-full"
                    />
                </div>

                <div>
                    <label htmlFor="password" className="block text-sm font-medium text-gray-700 mb-1">
                        Password
                    </label>
                    <Password
                        feedback={false}
                        toggleMask
                        id="password"
                        type="password"
                        placeholder="Enter your password"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                        required
                        className="w-full"
                    />
                </div>

                <button
                    type="submit"
                    className="text-center w-full !bg-primary text-white rounded-md py-2 mt-4 font-bold disabled:opacity-50 disabled:cursor-not-allowed"
                    disabled={!amount || !password}
                >
                    {processing ? "Verifying..." : "Next"}
                </button>
            </div>
        </form>
    )
}

