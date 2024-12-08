<?php

namespace App\Models;

use App\Traits\HasLatestScope;
use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    use HasLatestScope;
}
