export type ChatData = {
    id: number;
    uuid: string;
    is_read: boolean;
    is_notified: boolean;
    is_archived: boolean;
    is_pinned: boolean;
    last_message?: MessageData;
    from?: UserData;
    sender?: UserData;
    receiver?: UserData;
    typing?: Array<any>;
    is_typing?: any;
    sender_id: number;
    receiver_id: number;
    created_at: string;
    updated_at: string;
    created_at_human: string;
    updated_at_human: string;
};
export type MessageData = {
    id: number;
    uuid: string;
    chat?: ChatData;
    by_me: boolean;
    chat_id: number;
    sender_id: number;
    receiver_id: number;
    type: MessageType;
    body: string;
    created_at: string;
    updated_at: string;
    created_at_human: string;
    updated_at_human: string;
};
export type MessageType =
    | 'text'
    | 'money_request'
    | 'release_request'
    | 'money_request_accepted'
    | 'release_request_accepted';
export type UserData = {
    id: number;
    uuid: string;
    referral_id?: string;
    email_verified_at?: string;
    name: string;
    email: string;
    username: string;
    avatar?: string;
    phone?: string;
    type?: UserType;
    created_at: string;
    updated_at: string;
    created_at_human: string;
    updated_at_human: string;
};
export type UserType = 'customer' | 'admin';
export type WalletData = {
    id: number;
    uuid: string;
    user: UserData;
    status: WalletStatus;
    type: WalletType;
    transaction_type: WalletTransactionType;
    amount: number;
    currency: string;
    commission?: number;
    method?: string;
    transaction_id?: string;
    note?: string;
    payment_number?: string;
    approved_at?: string;
    cancelled_at?: string;
    failed_at?: string;
    created_at: string;
    updated_at: string;
    created_at_human: string;
    updated_at_human: string;
};
export type WalletStatus = 'pending' | 'approved' | 'failed' | 'cancelled';
export type WalletTransactionType =
    | 'deposit'
    | 'withdraw'
    | 'transfer_in'
    | 'transfer_out'
    | 'earn';
export type WalletType = 'debit' | 'credit';
