import { ChatData } from "@/types/_generated";
import { Link, usePage } from "@inertiajs/react";
import { Dialog } from "primereact/dialog";
import { InputNumber } from "primereact/inputnumber";

export default function Topbar() {
    const chat = usePage().props.chat as ChatData;
    const { balance } = useBalance(chat.from);
    const [visible, setVisible] = useState(false);
    return (
        <div className="top">
            <div className="container">
                <div className="inside">
                    {/*<div className="status online"></div>*/}
                    <div className="data flex items-center gap-2">
                        <Link href={route('chat.index')}>
                            <button className="btn back-to-mesg" title="Back">
                                <i className="ti-arrow-left"></i>
                            </button>
                        </Link>
                        <img
                            className="avatar-md"
                            src={chat.from?.avatar}
                            data-toggle="tooltip"
                            data-placement="top"
                            title={chat.from?.name}
                            alt={chat.from?.name + "'s avatar"}
                        />
                        <h5><a href="#">{chat.from?.name}</a></h5>
                        {/*<span>Active now</span>*/}
                    </div>
                    <button onClick={() => setVisible(true)} className="p-2">
                        <i className="pi pi-ellipsis-v" />
                    </button>
                    <Dialog header="Money Request" visible={visible} onHide={() => setVisible(false)}>
                        <div>
                            <p>Balance: {balance}</p>

                            <div className="flex items-center gap-3">
                                <InputLabel htmlFor="amount">Request Amount</InputLabel>
                                <InputNumber id="amount" max={balance} min={0} placeholder="Amount" />
                            </div>
                        </div>
                    </Dialog>
                </div>
            </div>
        </div>
    )
}
