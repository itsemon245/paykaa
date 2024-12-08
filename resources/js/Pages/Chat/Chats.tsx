export default function Chats() {
    const [isLoading, setIsLoading] = useState(true);
    const textAreaRef = useRef<HTMLTextAreaElement>(null);
    useEffect(() => {
        setTimeout(() => {
            setIsLoading(false);
        }, 1500);

    }, [])
    if (isLoading) {
        return <div className="h-screen w-screen flex items-center justify-center">
            <i className="pi pi-spinner pi-spin text-5xl text-gray-500" />

        </div>
    }
    return (
        <>
            <Head title="Chats">
                <link rel="stylesheet" href="/assets/chat/css/bootstrap.min.css" />
                <link rel="stylesheet" href="/assets/chat/css/perfect-scrollbar.min.css" />
                <link rel="stylesheet" href="/assets/chat/css/themify-icons.css" />
                <link rel="stylesheet" href="/assets/chat/css/emoji.css" />
                <link rel="stylesheet" href="/assets/chat/css/style.css" />
                <link rel="stylesheet" href="/assets/chat/css/responsive.css" />

                <script src="/assets/chat/js/jquery3.3.1.js" defer></script>
                <script src="/assets/chat/js/vendor/jquery-slim.min.js" defer></script>
                <script src="/assets/chat/js/vendor/popper.min.js" defer></script>
                <script src="/assets/chat/js/bootstrap.min.js" defer></script>
                <script src="/assets/chat/js/perfect-scrollbar.min.js" defer></script>
                <script src="/assets/chat/js/script.js" defer></script>
            </Head>
            <div className="layout">
                {/* <Topbar /> */}
                <Sidebar />

                <div
                    className="modal fade"
                    id="exampleModalCenter"
                    role="dialog"
                    aria-hidden="true"
                >
                    <div className="modal-dialog modal-dialog-centered" role="document">
                        <div className="requests">
                            <div className="title">
                                <h1>Add your friends</h1>
                                <button
                                    type="button"
                                    className="btn"
                                    data-dismiss="modal"
                                    aria-label="Close"
                                >
                                    <i className="ti-close"></i>
                                </button>
                            </div>
                            <div className="content">
                                <form>
                                    <div className="form-group">
                                        <label htmlFor="user">Username:</label>
                                        <input
                                            type="text"
                                            className="form-control"
                                            id="user"
                                            placeholder="Add recipient..."
                                            required
                                        />
                                        <div className="user" id="contact">
                                            <img
                                                className="avatar-sm"
                                                src="/assets/chat/img/avatars/avatar-female-5.jpg"
                                                alt="avatar"
                                            />
                                            <h5>Karen joye</h5>
                                            <button type="reset" className="btn">
                                                <i className="ti-close"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="welcome">Message:</label>
                                        <textarea
                                            className="text-control"
                                            id="welcome"
                                            placeholder="Send your welcome message..."
                                        >
                                            Hi Karen joye, I'd like to add you as a contact.</textarea
                                        >
                                    </div>
                                    <button type="submit" className="btn button w-100">
                                        Send Friend Request
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    className="modal fade"
                    id="startnewchat"
                    role="dialog"
                    aria-hidden="true"
                >
                    <div className="modal-dialog modal-dialog-centered" role="document">
                        <div className="requests">
                            <div className="title">
                                <h1>Start new chat</h1>
                                <button
                                    type="button"
                                    className="btn"
                                    data-dismiss="modal"
                                    aria-label="Close"
                                >
                                    <i className="ti-close"></i>
                                </button>
                            </div>
                            <div className="content">
                                <form>
                                    <div className="form-group">
                                        <label htmlFor="participant">Recipient:</label>
                                        <input
                                            type="text"
                                            className="form-control"
                                            id="participant"
                                            placeholder="Add recipient..."
                                            required
                                        />
                                        <div className="user" id="recipient">
                                            <img
                                                className="avatar-sm"
                                                src="/assets/chat/img/avatars/avatar-female-5.jpg"
                                                alt="avatar"
                                            />
                                            <h5>Karen joye</h5>
                                            <button type="reset" className="btn">
                                                <i className="ti-close"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="topic">Topic:</label>
                                        <input
                                            type="text"
                                            className="form-control"
                                            id="topic"
                                            placeholder="What's the topic?"
                                            required
                                        />
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="message">Message:</label>
                                        <textarea
                                            className="text-control"
                                            id="message"
                                            placeholder="Send your welcome message..."
                                        >
                                            Hmm, are you friendly?</textarea
                                        >
                                    </div>
                                    <button type="submit" className="btn button w-100">
                                        Start New Chat
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div className="main" id="chat-dialog">
                    <div className="tab-content" id="nav-tabContent">
                        <div
                            className="babble tab-pane fade active show"
                            id="list-chat"
                            role="tabpanel"
                            aria-labelledby="list-chat-list"
                        >
                            <div className="chat" id="chat1">
                                <div className="top">
                                    <div className="container">
                                        <div className="col-md-12">
                                            <div className="inside">
                                                <div className="status online"></div>
                                                <div className="data">
                                                    <h5><a href="#">Sarah Dalton</a></h5>
                                                    <span>Active now</span>
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
                                <div className="content" id="content">
                                    <div className="container">
                                        <div className="col-md-12">
                                            <div className="date">
                                                <hr />
                                                <span>Yesterday</span>
                                                <hr />
                                            </div>
                                            <div className="message">
                                                <img
                                                    className="avatar-md"
                                                    src="/assets/chat/img/avatars/avatar-female-5.jpg"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Karen joye"
                                                    alt="avatar"
                                                />
                                                <div className="text-main">
                                                    <div className="text-group">
                                                        <div className="text">
                                                            <p>
                                                                Where was i, i worry about my viewrs missing me
                                                                too much!
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <span>09:46 AM</span>
                                                </div>
                                            </div>
                                            <div className="message me">
                                                <div className="text-main">
                                                    <div className="text-group me">
                                                        <div className="text me">
                                                            <p>
                                                                But if you are not available to talk, then
                                                                would't they miss you more?
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <span>11:32 AM</span>
                                                </div>
                                            </div>
                                            <div className="message">
                                                <img
                                                    className="avatar-md"
                                                    src="/assets/chat/img/avatars/avatar-female-5.jpg"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Karen joye"
                                                    alt="avatar"
                                                />
                                                <div className="text-main">
                                                    <div className="text-group">
                                                        <div className="text">
                                                            <p>Aren't you sweet.</p>
                                                        </div>
                                                    </div>
                                                    <span>02:56 PM</span>
                                                </div>
                                            </div>
                                            <div className="message me">
                                                <div className="text-main">
                                                    <div className="text-group me">
                                                        <div className="text me">
                                                            <p>That's not an answer..</p>
                                                        </div>
                                                    </div>
                                                    <div className="text-group me">
                                                        <div className="text me">
                                                            <p>I am tres sorry, what were you saying?</p>
                                                        </div>
                                                    </div>
                                                    <span>10:21 PM</span>
                                                </div>
                                            </div>
                                            <div className="message">
                                                <img
                                                    className="avatar-md"
                                                    src="/assets/chat/img/avatars/avatar-female-5.jpg"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Karen joye"
                                                    alt="avatar"
                                                />
                                                <div className="text-main">
                                                    <div className="text-group">
                                                        <div className="text">
                                                            <p>
                                                                Great start guys, why can you only talk at
                                                                certain time on certain days?
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <span>11:07 PM</span>
                                                </div>
                                            </div>
                                            <div className="date">
                                                <hr />
                                                <span>Today</span>
                                                <hr />
                                            </div>
                                            <div className="message me">
                                                <div className="text-main">
                                                    <div className="text-group me">
                                                        <div className="text me">
                                                            <p>
                                                                hmmmm, Well done all. send me document please
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <span>10:21 PM</span>
                                                </div>
                                            </div>
                                            <div className="message">
                                                <img
                                                    className="avatar-md"
                                                    src="/assets/chat/img/avatars/avatar-female-5.jpg"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Karen joye"
                                                    alt="avatar"
                                                />
                                                <div className="text-main">
                                                    <div className="text-group">
                                                        <div className="text">
                                                            <div className="attachment">
                                                                <button
                                                                    className="btn attach"
                                                                    title="Click to download"
                                                                >
                                                                    <i className="ti-file"></i>
                                                                </button>
                                                                <div className="file">
                                                                    <h5>
                                                                        <a href="#" title="Click to download"
                                                                        >Policy Sheet.pdf</a
                                                                        >
                                                                    </h5>
                                                                    <span>80kb Document</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span>11:07 PM</span>
                                                </div>
                                            </div>
                                            <div className="message me">
                                                <div className="text-main">
                                                    <div className="text-group me">
                                                        <div className="text me">
                                                            <p>
                                                                i have received the .pdf document please send me
                                                                jpeg file for our requirement..
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <span><i className="ti-check"></i>10:21 PM</span>
                                                </div>
                                            </div>
                                            <div className="message">
                                                <img
                                                    className="avatar-md"
                                                    src="/assets/chat/img/avatars/avatar-female-5.jpg"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Karen joye"
                                                    alt="avatar"
                                                />
                                                <div className="text-main">
                                                    <div className="text-group">
                                                        <div className="text typing">
                                                            <div className="wave">
                                                                <span className="dot"></span>
                                                                <span className="dot"></span>
                                                                <span className="dot"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div className="container">
                                    <div className="col-md-12">
                                        <div className="bottom">
                                            <form className="text-area">
                                                <textarea
                                                    ref={textAreaRef}
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
                </div>
            </div>
        </>

    )
}
