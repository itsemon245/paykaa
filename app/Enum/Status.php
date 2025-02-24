<?php

namespace App\Enum;

enum Status: string
{
    case RELEASED = 'completed';
    case WAITING_FOR_RELEASE = 'waiting for release';
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case FAILED = 'failed';
    case REJECTED = 'rejected';
    case CANCELLED = 'cancelled';
    case NOT_VERIFIED = 'not verified';
}
