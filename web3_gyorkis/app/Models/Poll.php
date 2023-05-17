<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Poll extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'running',
        'is_multiple',
        'number_of_submits'
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(PollOption::class);
    }

    public function fills() : HasMany
    {
        return $this->hasMany(PollAnswer::class);
    }
}
