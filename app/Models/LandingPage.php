<?php

namespace App\Models;


class LandingPage extends Model
{
    protected $casts = [
        'hero' => 'array',
        'payment_methods' => 'array',
        'how_it_works' => 'array',
        'socials' => 'array',
    ];
}
