import { ChatData } from "@/types/_generated";
import { defaultAvatar, image } from "@/utils";
import { Link, usePage } from "@inertiajs/react";

export default function Topbar() {
    const chat = usePage().props.chat as ChatData;
    const { activeStatus } = useActiveStatus(chat.from);
    return (
        <div className="top max-sm:!py-3 px-2">
            <div className="container">
                <div className="inside">
                    <div className="data flex items-center gap-2 w-full">
                        <Link href={route('chat.index')} className="hidden: lg:inline-block me-2">
                            <button className="!bg-gray-200 !rounded-full w-9 h-9 flex items-center justify-center" title="Back">
                                <i className="ti-angle-left fw-bold !text-gray-800"></i>
                            </button>
                        </Link>
                        <div className="relative">
                            <img
                                className="avatar-md"
                                src={image(chat.from?.avatar)}
                                onError={(e) => {
                                    //@ts-ignore
                                    e.target.src = defaultAvatar
                                }}
                                data-toggle="tooltip"
                                data-placement="top"
                                title={chat.from?.name}
                                alt={chat.from?.name + "'s avatar"}
                            />
                            {activeStatus === true && <span className="absolute bottom-1 border-white border-2 right-4 bg-green-500 rounded-full w-3 h-3"></span>}
                        </div>
                        <div className="flex items-center gap-2 justify-between w-full grow">
                            <div>
                                <h5><a href="#">{chat.from?.name}</a></h5>
                                {activeStatus && <span>{activeStatus === true ? "Active now" : activeStatus}</span>}
                            </div>
                            <RequestMoneyChatList chat={chat} />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}
