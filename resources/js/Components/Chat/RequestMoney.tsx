import { ChatData } from "@/types/_generated";
import { Button } from "primereact/button";
import { Dialog } from "primereact/dialog";
import { InputNumber } from "primereact/inputnumber";

export default function RequestMoney({ chat }: { chat: ChatData }) {
    const [visible, setVisible] = useState(false);
    const { balance } = useBalance(chat.from);
    return (
        <>
            <Button rounded className="!rounded-lg" title="Request Money" onClick={() => setVisible(true)}>
                <HugeiconsMoneyReceiveCircle className="h-6 w-6" />
            </Button>
            <Dialog header="Request Money" footer={() => {
                return <div className="*:!rounded-md flex md:flex-row-reverse mt-3 justify-end gap-3">
                    <Button outlined label="Cancel" onClick={() => setVisible(false)} />
                    <Button label="Request" onClick={() => setVisible(false)} />
                </div>
            }} visible={visible} onHide={() => setVisible(false)}>
                <div className="flex flex-col gap-3">
                    <p className="!font-bold">Balance: {balance}</p>
                    <p className="!font-bold">Contact: {chat.from?.phone}</p>

                    <div className="flex flex-col">
                        <InputLabel htmlFor="amount" className="!font-medium">Amount</InputLabel>
                        <InputNumber id="amount" max={balance} min={0} placeholder="Amount" />
                    </div>
                </div>
            </Dialog>
        </>
    );
}
