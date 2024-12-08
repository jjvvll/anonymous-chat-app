<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PrivateRoom extends Model
{
    use HasFactory;
    protected $fillable = ['nickname', 'owner', 'password'];


    public function privateMessages()
    {
        return $this->hasMany(PrivateMessage::class);
    }

    public function scopeCheckDuplicate(Builder $query, string $nickname): Builder{
        return $query->where('nickname', '=', $nickname);
    }

    public function scopeCheckPass(Builder $query, string $password): Builder{
        return $query->where('password', '=', $password);
    }
}
