<?php

namespace App\Models;

use App\Traits\HasUuid;


class Kyc extends Model
{
    use HasUuid;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusAttribute(): string
    {
        if ($this->rejected_at) {
            return 'Rejected';
        }
        return $this->approved_at ? 'Approved' : 'Pending';
    }
}
