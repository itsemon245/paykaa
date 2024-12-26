export type RouteParams = {
    "chat.index": {};
    "chat.check-new-messages": {};
    "chat.receiver-chat": {
        receiver: string;
    };
    "chat.user-chats": {};
    "chat.show": {
        chat: string;
    };
    "chat.typing": {
        chat: string;
    };
    "messages.check-new": {
        chat: string;
    };
    "password.confirm": {};
    "dashboard": {};
    "verification.send": {};
    "password.request": {};
    "password.email": {};
    "messages.get-new": {
        chat: string;
    };
    "login": {};
    "logout": {};
    "messages": {};
    "message.store": {
        chat: string;
    };
    "password.update": {};
    "profile.edit": {};
    "profile.update": {};
    "profile.destroy": {};
    "register": {};
    "password.store": {};
    "password.reset": {
        token: string;
    };
    "search-users": {};
    "verification.notice": {};
    "verification.verify": {
        id: string;
        hash: string;
    };
    "wallet.check-balance": {};
    "wallet.deposit.index": {};
    "wallet.deposit.store": {};
    "wallet.transactions.index": {};
    "wallet.withdraw.index": {};
    "wallet.withdraw.store": {};
};
