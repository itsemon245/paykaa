export type ChatData = {
    id: number;
    uuid: string;
    is_read: boolean;
    is_notified: boolean;
    is_archived: boolean;
    is_pinned: boolean;
    last_message?: MessageData;
    sender?: UserData;
    receiver?: UserData;
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
    chat: ChatData;
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
export enum MessageType {
    'Text' = 'text',
    'MoneyRequest' = 'money_request',
    'ReleaseRequest' = 'release_request',
    'MoneyRequestAccepted' = 'money_request_accepted',
    'ReleaseRequestAccepted' = 'release_request_accepted',
}
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
export enum UserType {
    'Customer' = 'customer',
    'Admin' = 'admin',
}
