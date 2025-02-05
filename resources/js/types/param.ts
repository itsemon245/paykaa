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
    "filament.admin.resources.add-methods.index": {};
    "filament.admin.resources.adds.index": {};
    "filament.admin.resources.deposit-methods.index": {};
    "filament.admin.resources.deposits.index": {};
    "filament.admin.resources.kycs.index": {};
    "admin.login-as": {
        user: string;
    };
    "filament.admin.resources.money-requests.index": {};
    "filament.admin.resources.transactions.index": {};
    "filament.admin.resources.users.index": {};
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
    "active-status.check": {
        user?: string;
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
    "messages.money-requests": {
        chat: string;
    };
    "money.request": {};
    "money.accept": {
        moneyRequest: string;
    };
    "money.cancel": {
        moneyRequest: string;
    };
    "money.reject": {
        moneyRequest: string;
    };
    "money.release": {
        moneyRequest: string;
    };
    "money.request-release": {
        moneyRequest: string;
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
    "active-status.update": {};
    "upload.chunk.start": {};
    "upload.chunk.update": {};
    "verification.notice": {};
    "verification.verify": {
        id: string;
        hash: string;
    };
    "wallet.check-balance": {
        user?: string;
    };
    "wallet.deposit.index": {};
    "wallet.deposit.store": {};
    "wallet.transactions.index": {};
    "wallet.withdraw.index": {};
    "wallet.withdraw.store": {};
};
