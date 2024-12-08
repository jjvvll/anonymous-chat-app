<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrivateMessage extends Model
{
     public function privateRoom()
    {
        return $this->belongsTo(PrivateRoom::class);
    }
}
