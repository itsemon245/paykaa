<?php

namespace App\Models;

use App\Traits\HasLatestScope;
use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    use HasLatestScope;

    function getCreatedAtHumanAttribute()
    {
        return $this->created_at?->diffForHumans();
    }
    function getUpdatedAtHumanAttribute()
    {
        return $this->updated_at?->diffForHumans();
    }
}
