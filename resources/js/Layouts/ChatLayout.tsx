
export default function ChatLayout({ children }: { children: any }) {
    const [isLoading, setIsLoading] = useState(true);
    useEffect(() => {
        setTimeout(() => {
            setIsLoading(false);
        }, 1500);
    }, [])
    if (isLoading) {
        return <div className="h-screen w-screen flex items-center justify-center">
            <i className="pi pi-spinner pi-spin text-5xl text-primary" />
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

                {/*
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

                */}
                {/*
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

                    */}


                <div className="main" id="chat-dialog">
                    {children}
                </div>
            </div>
        </>

    )
}
