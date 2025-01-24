import { ChatData } from "@/types/_generated";
import { image, poll } from "@/utils";
import { Link, usePage } from "@inertiajs/react";
import { Dialog } from "primereact/dialog";
import { InputNumber } from "primereact/inputnumber";

export default function Topbar() {
    const chat = usePage().props.chat as ChatData;
    const { balance } = useBalance(chat.from);
    const [visible, setVisible] = useState(false);
    const { activeStatus } = useActiveStatus(chat.from);
    return (
        <div className="top">
            <div className="container">
                <div className="inside">
                    <div className="data flex items-center gap-2">
                        <Link href={route('chat.index')}>
                            <button className="btn back-to-mesg" title="Back">
                                <i className="ti-arrow-left"></i>
                            </button>
                        </Link>
                        <div className="relative">
                            <img
                                className="avatar-md"
                                src={image(chat.from?.avatar)}
                                data-toggle="tooltip"
                                data-placement="top"
                                title={chat.from?.name}
                                alt={chat.from?.name + "'s avatar"}
                            />
                            {activeStatus === true && <span className="absolute bottom-1 border-white border-2 right-4 bg-green-500 rounded-full w-3 h-3"></span>}
                        </div>
                        <div>
                            <h5><a href="#">{chat.from?.name}</a></h5>
                            {activeStatus && <span>{activeStatus === true ? "Active now" : activeStatus}</span>}
                        </div>
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
