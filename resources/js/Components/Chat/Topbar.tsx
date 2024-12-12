import { ChatData } from "@/types/_generated";
import { usePage } from "@inertiajs/react";

export default function Topbar() {
    const chat = usePage().props.chat as ChatData;
    return (
        <div className="top">
            <div className="container">
                <div className="col-md-12">
                    <div className="inside">
                        {/*<div className="status online"></div>*/}
                        <div className="data flex items-center gap-2">
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
                        <button
                            className="btn d-md-block d-none audio-call"
                            title="Audio call"
                        >
                            <i className="ti-headphone-alt"></i>
                        </button>
                        <button
                            className="btn d-md-block d-none video-call"
                            title="Video call"
                        >
                            <i className="ti-video-camera"></i>
                        </button>
                        <button
                            className="btn d-md-block d-none"
                            title="More Info"
                        >
                            <i className="ti-info"></i>
                        </button>
                        <div className="dropdown">
                            <button
                                className="btn"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                            >
                                <i className="ti-view-grid"></i>
                            </button>
                            <div className="dropdown-menu dropdown-menu-right">
                                <a href="#" className="dropdown-item audio-call"
                                ><i className="ti-headphone-alt"></i>Voice Call</a
                                >
                                <a href="#" className="dropdown-item video-call"
                                ><i className="ti-video-camera"></i>Video Call</a
                                >
                                <hr />
                                <a href="#" className="dropdown-item"
                                ><i className="ti-server"></i>Clear History</a
                                >
                                <a href="#" className="dropdown-item"
                                ><i className="ti-hand-stop"></i>Block Contact</a
                                >
                                <a href="#" className="dropdown-item"
                                ><i className="ti-trash"></i>Delete Contact</a
                                >
                            </div>
                        </div>
                        <button className="btn back-to-mesg" title="Back">
                            <i className="ti-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    )
}
