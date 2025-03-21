export type AddData = {
    id: number | null;
    uuid: string | null;
    owner?: UserData;
    addMethod?: AddMethodData;
    type?: AddType;
    owner_id: number;
    add_method_id?: number;
    contact: string | null;
    amount: number;
    rate: number | null;
    limit_max?: number;
    limit_min?: number;
    created_at?: string;
    updated_at?: string;
    created_at_human?: string;
    updated_at_human?: string;
};
export type AddMethodData = {
    id: number;
    name: string;
    logo?: string;
    color?: string;
    created_at?: string;
    updated_at?: string;
    created_at_human?: string;
    updated_at_human?: string;
};
export type AddType = 'Buy' | 'Sell';
export type AdditionalFields = {
    name: string;
    value?: string;
    label?: string;
    type?: InputType;
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
    created_at?: string;
    updated_at?: string;
    created_at_human?: string;
    updated_at_human?: string;
};
export type DepositMethodData = {
    id: number;
    uuid: string;
    charge: number;
    is_fixed_amount: boolean;
    additional_fields?: Array<any>;
    label: string;
    logo: string;
    category: MethodCategory;
    mode?: MethodMode;
    number?: string;
    bank_name?: string;
    account_holder?: string;
    branch_name?: string;
    swift_code?: string;
    routing_number?: string;
    description?: string;
    secrets?: Array<any>;
    metadata?: Array<any>;
    created_at?: string;
    updated_at?: string;
    created_at_human?: string;
    updated_at_human?: string;
};
export type DepositMethodMetaData = {
    qr_code: string;
};
export type DurationData = {
    day: number;
    hour: number;
    minute: number;
};
export type EarningData = {
    id: number | null;
    user_id: number;
    user?: UserData;
    from_id: number;
    from?: UserData;
    amount: number;
    status: EarningStatus;
    created_at?: string;
    updated_at?: string;
    created_at_human?: string;
    updated_at_human?: string;
};
export type EarningStatus = 'pending' | 'approved' | 'converted';
export type FieldsData = {
    name: string;
    label: string;
    required: boolean;
    type?: InputType;
    placeholder?: string;
};
export type InputType = 'text' | 'textarea';
export type KycData = {
    doc_type?: KycDocType;
    front_image: string;
    back_image: string;
    approved_at?: string;
    rejected_at?: string;
    created_at?: string;
    updated_at?: string;
    created_at_human?: string;
    updated_at_human?: string;
};
export type KycDocType = 'Passport' | 'Driving License' | 'National ID';
export type MessageData = {
    id: number;
    uuid: string;
    chat?: ChatData;
    moneyRequest?: MoneyRequestData;
    by_me: boolean;
    is_read: boolean;
    body?: string;
    from?: UserData;
    replied_to?: number;
    parent?: MessageData;
    chat_id: number;
    sender_id: number;
    receiver_id: number;
    type: MessageType;
    created_at?: string;
    updated_at?: string;
    created_at_human?: string;
    updated_at_human?: string;
};
export type MessageType = 'text' | 'image' | 'money_request';
export type MethodCategory = 'Bank' | 'Cryptocurrency' | 'Mobile Banking';
export type MethodMode = 'personal' | 'agent' | 'payment';
export type MoneyRequestData = {
    uuid?: string;
    message?: MessageData;
    from?: UserData;
    reportedBy?: UserData;
    status: Status;
    by_me: boolean;
    sender_id: number;
    receiver_id: number;
    message_id: number;
    amount: number;
    reported_by: number | null;
    duration?: DurationData;
    currency?: string;
    note?: string;
    accepted_at?: string;
    cancelled_at?: string;
    release_requested_at?: string;
    released_at?: string;
    rejected_at?: string;
    expires_at?: string;
    reported_at?: string;
    created_at?: string;
    updated_at?: string;
    created_at_human?: string;
    updated_at_human?: string;
};
export type Status =
    | 'completed'
    | 'waiting for release'
    | 'pending'
    | 'approved'
    | 'Request Accepted'
    | 'Reported'
    | 'failed'
    | 'rejected'
    | 'cancelled'
    | 'not verified';
export type UserData = {
    id: number;
    uuid: string;
    referral_id?: string;
    balance?: number;
    email_verified_at?: string;
    active_status?: string | boolean;
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
    created_at?: string;
    updated_at?: string;
    created_at_human?: string;
    updated_at_human?: string;
};
export type UserType = 'customer' | 'admin';
export type WalletData = {
    id: number | null;
    uuid: string | null;
    owner_id: number | null;
    owner: UserData | null;
    user: UserData | null;
    status: WalletStatus | null;
    depositMethod: DepositMethodData | null;
    withdrawMethod: WithdrawMethodData | null;
    type: WalletType;
    transaction_type: WalletTransactionType;
    amount: number;
    deposit_method_id?: number;
    withdraw_method_id?: number;
    additional_fields?: Array<AdditionalFields>;
    currency: string | null;
    commission?: number;
    method?: string;
    transaction_id?: string;
    note?: string;
    receipt?: string;
    payment_number?: string;
    account_holder?: string;
    approved_at?: string;
    cancelled_at?: string;
    failed_at?: string;
    created_at?: string;
    updated_at?: string;
    created_at_human?: string;
    updated_at_human?: string;
};
export type WalletStatus = 'pending' | 'approved' | 'failed' | 'cancelled';
export type WalletTransactionType = 'deposit' | 'withdraw' | 'transfer' | 'earn';
export type WalletType = 'debit' | 'credit';
export type WithdrawMethodData = {
    id: number;
    uuid: string;
    label: string;
    logo: string;
    category: MethodCategory;
    description?: string;
    fields?: Array<FieldsData>;
    created_at?: string;
    updated_at?: string;
    created_at_human?: string;
    updated_at_human?: string;
};
