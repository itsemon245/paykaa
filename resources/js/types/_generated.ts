export enum MessageType {
    'Text' = 'text',
    'MoneyRequest' = 'money_request',
    'ReleaseRequest' = 'release_request',
    'MoneyRequestAccepted' = 'money_request_accepted',
    'ReleaseRequestAccepted' = 'release_request_accepted',
}
export type UserData = {
    id: number;
    referral_id?: string;
    email_verified_at?: string;
    name: string;
    email: string;
    username: string;
    avatar?: string;
    phone?: string;
    type?: UserType;
};
export enum UserType {
    'Customer' = 'customer',
    'Admin' = 'admin',
}
