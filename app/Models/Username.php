<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Username extends Model
{
    use HasFactory;

    protected $fillable = ['username'];

    public function scopeCheckDuplicate(Builder $query, string $username): Builder{
        return $query->where('username', '=', $username);
    }
    public function scopeGenerateUniqueUsername(Builder $query, $length = 10)
    {
        // Generate a random username
        $randomUsername = Str::random($length);

        // Ensure the generated room name is unique
        while ($query->where('username', $randomUsername)->exists()) {
            // Regenerate the room name if it already exists
            $randomUsername = Str::random($length);
        }

        // Return the unique room name
        return $randomUsername;
    }

}
