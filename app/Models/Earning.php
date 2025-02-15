<?php

namespace App\Models;


class Earning extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function from()
    {
        return $this->belongsTo(User::class, 'from_id');
    }
}
