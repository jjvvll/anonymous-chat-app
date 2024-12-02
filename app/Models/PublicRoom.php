<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PublicRoom extends Model
{
    use HasFactory;

    protected $fillable = ['publicRoom'];

    public function scopeGenerateUniquePublicRoom(Builder $query, $length = 10)
    {
        // Generate a random room name of the specified length
        $randomRoomName = Str::random($length);

        // Ensure the generated room name is unique
        while ($query->where('publicRoom', $randomRoomName)->exists()) {
            // Regenerate the room name if it already exists
            $randomRoomName = Str::random($length);
        }

        // Return the unique room name
        return $randomRoomName;
    }

}
