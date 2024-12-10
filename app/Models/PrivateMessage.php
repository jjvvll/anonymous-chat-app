<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrivateMessage extends Model
{

    protected $fillable =['message', 'private_room_id', 'sender'];
     public function privateRoom()
    {
        return $this->belongsTo(PrivateRoom::class);
    }
}
