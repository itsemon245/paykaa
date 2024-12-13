import { ChatData } from "@/types/_generated";
import { Link, usePage } from "@inertiajs/react";

export default function Topbar() {
    const chat = usePage().props.chat as ChatData;
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
                </div>
            </div>
        </div>
    )
}
