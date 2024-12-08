export default function Topbar() {
    return (
        <div className="navigation">
            <div className="container">
                <div className="inside">
                    <div className="nav nav-tab menu">
                        <a href="#settings" data-toggle="tab" title="User Setting">
                            <i className="ti-panel"></i>
                            Setting
                        </a>
                        <a href="#members" data-toggle="tab" title="All members">
                            <i className="ti-home"></i>
                            All Friends
                        </a>
                        <a
                            href="#discussions"
                            data-toggle="tab"
                            className="active"
                            title="Chat"
                        >
                            <i className="ti-comment-alt"></i>
                            Recent Chat
                        </a>
                        <a
                            href="#notifications"
                            data-toggle="tab"
                            className="f-grow1"
                            title="Notifications"
                        >
                            <i className="ti-bell"></i>
                            Notifications
                        </a>
                        <a
                            href="#"
                            id="dark"
                            className="dark-theme"
                            title="Use Night Mode"
                        >
                            <i className="ti-wand"></i>
                            Night Mode
                        </a>
                        <a href="sign-in.html" className="btn power" title="Sign Out"
                        ><i className="ti-power-off"></i
                        ></a>
                    </div>
                </div>
            </div>
        </div>
    )
}

