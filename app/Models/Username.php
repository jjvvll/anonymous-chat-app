<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Username extends Model
{
    use HasFactory;

    protected $fillable = ['username'];

    public function scopeGenerateUniqueUsername(Builder $query, $length = 10)
    {
        // Generate a random username
        $randomUsername = \Illuminate\Support\Str::random($length);

        // Ensure the generated username is unique
        while ($query->where('username', $randomUsername)->exists()) {
            $randomUsername = \Illuminate\Support\Str::random($length); // Generate a new one if it already exists
        }

        return $randomUsername;
    }

    public function scopeHasDuplicate(Builder $query, $username)
    {
        // Check if the given username already exists in the table
        return $query->where('username', $username)->exists();
    }
}
