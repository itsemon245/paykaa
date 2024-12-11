import { PaginatedCollection } from "@/types";
import { MessageData } from "@/types/_generated";
import { usePage } from "@inertiajs/react";

export default function Show() {
    const messagesProp = usePage().props.messages as PaginatedCollection<MessageData> | undefined;
    const [messages, setMessages] = useState<PaginatedCollection<MessageData>>();
    useEffect(() => {
        setMessages(messagesProp);
        console.log(messages);
    }, []);
    return (
        <div className="tab-content" id="nav-tabContent">
            <div
                className="babble tab-pane fade active show"
                id="list-chat"
                role="tabpanel"
                aria-labelledby="list-chat-list"
            >
                <div className="chat" id="chat1">
                    <Topbar />
                    <Messages messages={messages} />
                    <div className="container">
                        <div className="col-md-12">
                            <div className="bottom">
                                <form className="text-area">
                                    <textarea
                                        className="form-control"
                                        placeholder="Start typing for reply..."
                                        rows={1}
                                    ></textarea>
                                    <div className="add-smiles">
                                        <span title="add icon" className="em em-blush"></span>
                                    </div>
                                    <div className="smiles-bunch">
                                        <i className="em em---1"></i>
                                        <i className="em em-smiley"></i>
                                        <i className="em em-anguished"></i>
                                        <i className="em em-laughing"></i>
                                        <i className="em em-angry"></i>
                                        <i className="em em-astonished"></i>
                                        <i className="em em-blush"></i>
                                        <i className="em em-disappointed"></i>
                                        <i className="em em-worried"></i>
                                        <i className="em em-kissing_heart"></i>
                                        <i className="em em-rage"></i>
                                        <i className="em em-stuck_out_tongue"></i>
                                        <i className="em em-expressionless"></i>
                                        <i className="em em-bikini"></i>
                                        <i className="em em-christmas_tree"></i>
                                        <i className="em em-facepunch"></i>
                                        <i className="em em-pushpin"></i>
                                        <i className="em em-tada"></i>
                                        <i className="em em-us"></i>
                                        <i className="em em-rose"></i>
                                    </div>
                                    <button type="submit" className="btn send">
                                        <i className="ti-location-arrow"></i>
                                    </button>
                                </form>
                                <label>
                                    <input type="file" />
                                    <span className="btn attach"
                                    ><i className="ti-clip"></i
                                    ></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div className="call" id="call1">
                    <div className="content">
                        <div className="container">
                            <div className="col-md-12">
                                <div className="inside">
                                    <div className="panel">
                                        <div className="participant">
                                            <img
                                                className="avatar-xxl"
                                                src="/assets/chat/img/avatars/avatar-female-5.jpg"
                                                alt="avatar"
                                            />
                                            <span>Connecting to Sarah</span>
                                            <div className="wave">
                                                <span className="dot"></span>
                                                <span className="dot"></span>
                                                <span className="dot"></span>
                                            </div>
                                        </div>
                                        <div className="options">
                                            <button className="btn option">
                                                <i className="ti-microphone"></i>
                                            </button>
                                            <button className="btn option">
                                                <i className="ti-video-camera"></i>
                                            </button>
                                            <button className="btn option">
                                                <i className="ti-user">+</i>
                                            </button>
                                            <button className="btn option">
                                                <i className="ti-volume"></i>
                                            </button>
                                            <button className="btn option">
                                                <i className="ti-comment"></i>
                                            </button>
                                        </div>
                                        <button className="btn option call-end">
                                            <i className="ti-close"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div
                className="babble tab-pane fade"
                id="list-empty"
                role="tabpanel"
                aria-labelledby="list-empty-list"
            >
                <div className="chat" id="chat">
                    <div className="top">
                        <div className="container">
                            <div className="col-md-12">
                                <div className="inside">
                                    <div className="status offline"></div>
                                    <div className="data">
                                        <h5><a href="#">Bob Frank</a></h5>
                                        <span>Inactive</span>
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
                                            <a href="#" className="dropdown-item"
                                            ><i className="ti-headphone-alt"></i>Voice Call</a
                                            >
                                            <a href="#" className="dropdown-item"
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
                    <div className="content empty">
                        <div className="container">
                            <div className="col-md-12">
                                <div className="no-messages">
                                    <i className="ti-comments"></i>
                                    <p>
                                        Seems people are shy to start the chat. Break the ice
                                        send the first message.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="container">
                        <div className="col-md-12">
                            <div className="bottom">
                                <form className="text-area">
                                    <textarea
                                        className="form-control"
                                        placeholder="Start typing for reply..."
                                        rows={1}
                                    ></textarea>
                                    <div className="add-smiles">
                                        <span title="add icon" className="em em-blush"></span>
                                    </div>
                                    <div className="smiles-bunch">
                                        <i className="em em---1"></i>
                                        <i className="em em-smiley"></i>
                                        <i className="em em-anguished"></i>
                                        <i className="em em-laughing"></i>
                                        <i className="em em-angry"></i>
                                        <i className="em em-astonished"></i>
                                        <i className="em em-blush"></i>
                                        <i className="em em-disappointed"></i>
                                        <i className="em em-worried"></i>
                                        <i className="em em-kissing_heart"></i>
                                        <i className="em em-rage"></i>
                                        <i className="em em-stuck_out_tongue"></i>
                                        <i className="em em-expressionless"></i>
                                        <i className="em em-bikini"></i>
                                        <i className="em em-christmas_tree"></i>
                                        <i className="em em-facepunch"></i>
                                        <i className="em em-pushpin"></i>
                                        <i className="em em-tada"></i>
                                        <i className="em em-us"></i>
                                        <i className="em em-rose"></i>
                                    </div>
                                    <button type="submit" className="btn send">
                                        <i className="ti-location-arrow"></i>
                                    </button>
                                </form>
                                <label>
                                    <input type="file" />
                                    <span className="btn attach"
                                    ><i className="ti-clip"></i
                                    ></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div className="call" id="call2">
                    <div className="content">
                        <div className="container">
                            <div className="col-md-12">
                                <div className="inside">
                                    <div className="panel">
                                        <div className="participant">
                                            <img
                                                className="avatar-xxl"
                                                src="/assets/chat/img/avatars/avatar-female-2.jpg"
                                                alt="avatar"
                                            />
                                            <span>Connecting to sarah</span>
                                            <div className="wave">
                                                <span className="dot"></span>
                                                <span className="dot"></span>
                                                <span className="dot"></span>
                                            </div>
                                        </div>
                                        <div className="options">
                                            <button className="btn option">
                                                <i className="ti-microphone"></i>
                                            </button>
                                            <button className="btn option">
                                                <i className="ti-video-camera"></i>
                                            </button>
                                            <button className="btn option">
                                                <i className="ti-user">+</i>
                                            </button>
                                            <button className="btn option">
                                                <i className="ti-volume"></i>
                                            </button>
                                            <button className="btn option">
                                                <i className="ti-comment"></i>
                                            </button>
                                        </div>
                                        <button className="btn option call-end">
                                            <i className="ti-close"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}

