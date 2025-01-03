export type AdditionalFields = {
    name: string;
    value?: string;
};
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
    created_at_human?: string;
    updated_at_human?: string;
};
export type DepositMethodData = {
    id: number;
    uuid: string;
    label: string;
    logo: string;
    category: MethodCategory;
    mode?: MethodMode;
    number?: string;
    description?: string;
    secrets?: Array<any>;
    metadata?: Array<any>;
    created_at: string;
    updated_at: string;
    created_at_human?: string;
    updated_at_human?: string;
};
export type DepositMethodMetaData = {
    qr_code: string;
};
export type FieldsData = {
    name: string;
    label: string;
    required: boolean;
    type?: InputType;
    placeholder?: string;
};
export type InputType = 'text' | 'file' | 'textarea';
export type KycData = {
    user_id: number;
    doc_type?: KycDocType;
    front_image: string;
    back_image: string;
    approved_at?: string;
    rejected_at?: string;
    created_at: string;
    updated_at: string;
    created_at_human?: string;
    updated_at_human?: string;
};
export type KycDocType = 'Passport' | 'Driving License' | 'National ID';
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
    created_at_human?: string;
    updated_at_human?: string;
};
export type MessageType =
    | 'text'
    | 'money_request'
    | 'release_request'
    | 'money_request_accepted'
    | 'release_request_accepted';
export type MethodCategory = 'Bank' | 'Cryptocurrency' | 'Mobile Banking';
export type MethodMode = 'personal' | 'agent' | 'payment';
export type UserData = {
    id: number;
    uuid: string;
    referral_id?: string;
    balance?: number;
    email_verified_at?: string;
    name: string;
    email: string;
    avatar?: string;
    phone?: string;
    type?: UserType;
    gender?: string;
    date_of_birth?: string;
    country?: string;
    address?: string;
    password?: string;
    created_at: string;
    updated_at: string;
    created_at_human?: string;
    updated_at_human?: string;
};
export type UserType = 'customer' | 'admin';
export type WalletData = {
    id: number;
    uuid: string;
    owner_id: number;
    owner: UserData;
    status: WalletStatus;
    type: WalletType;
    transaction_type: WalletTransactionType;
    amount: number;
    additional_fields?: Array<AdditionalFields>;
    currency: string | null;
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
    created_at_human?: string;
    updated_at_human?: string;
};
export type WalletStatus = 'pending' | 'approved' | 'failed' | 'cancelled';
export type WalletTransactionType =
    | 'deposit'
    | 'withdraw'
    | 'transfer_in'
    | 'transfer_out'
    | 'earn';
export type WalletType = 'debit' | 'credit';
export type WithdrawMethodData = {
    id: number;
    uuid: string;
    label: string;
    logo: string;
    category: MethodCategory;
    description?: string;
    fields?: Array<FieldsData>;
    created_at: string;
    updated_at: string;
    created_at_human?: string;
    updated_at_human?: string;
};
