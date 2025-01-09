export type RouteParams = {
    "add.index": {};
    "add.store": {};
    "add.create": {};
    "add.show": {
        add: string;
    };
    "add.update": {
        add: string;
    };
    "add.destroy": {
        add: string;
    };
    "add.edit": {
        add: string;
    };
    "filament.admin.resources.adds.index": {};
    "filament.admin.resources.deposit-methods.index": {};
    "filament.admin.resources.deposits.index": {};
    "filament.admin.resources.kycs.index": {};
    "filament.admin.resources.withdraw-methods.index": {};
    "filament.admin.resources.withdraws.index": {};
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
    "kyc.store": {};
    "login": {};
    "logout": {};
    "marketplace.index": {};
    "messages": {};
    "message.store": {
        chat: string;
    };
    "password.update": {};
    "profile.edit": {};
    "profile.update": {};
    "profile.destroy": {};
    "profile.update.avatar": {};
    "register": {};
    "password.store": {};
    "password.reset": {
        token: string;
    };
    "search-users": {};
    "upload.chunk.start": {};
    "upload.chunk.update": {};
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
