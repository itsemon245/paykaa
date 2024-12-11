<?php

namespace App\Data\Partials;

use Carbon\Carbon;

trait TimestampData
{
    public Carbon $created_at;
    public Carbon $updated_at;
    public string $created_at_human;
    public string $updated_at_human;

    public function timestampDiffForHumans(){
        if($this->created_at){
            $this->created_at_human = $this->created_at->diffForHumans();
        }
        if($this->updated_at){
            $this->updated_at_human = $this->updated_at->diffForHumans();
        }
    }
}
