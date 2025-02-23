import { ChatData } from "@/types/_generated";
import { defaultAvatar, image } from "@/utils";
import { Link, usePage } from "@inertiajs/react";
import { AvatarGroup } from "primereact/avatargroup";
import { Avatar } from 'primereact/avatar';

export default function Topbar() {
    const chat = usePage().props.chat as ChatData;
    const { user, isAdmin } = useAuth()
    const { activeStatus } = useActiveStatus(chat.from);
    const isHelpline = route().current('helpline');
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
                            {isHelpline ?
                                <AvatarGroup>
                                    <Avatar image="/assets/favicon.png" size="large" shape="circle" />
                                </AvatarGroup> : <img
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
                                />}
                            {activeStatus === true && <span className="absolute bottom-1 border-white border-2 right-4 bg-green-500 rounded-full w-3 h-3"></span>}
                        </div>
                        <div className="flex items-center gap-2 justify-between w-full grow">
                            <div>
                                <h5><a href="#">{isHelpline && !isAdmin ? 'PayKaa' : chat.from?.name}</a></h5>
                                {
                                    isHelpline && !isAdmin ?
                                        <span>Helpline</span>
                                        : <>
                                            {activeStatus && <span>{activeStatus === true ? "Active now" : activeStatus}</span>}
                                        </>
                                }

                            </div>
                            {!isHelpline ? <RequestMoneyChatList chat={chat} /> : <>
                                <Link href={route('dashboard')} className="w-10 h-10 flex items-center justify-center p-1.5 transition-all rounded-full" as="a">
                                    <HugeiconsCancelCircle className="" />
                                </Link>
                            </>}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}
