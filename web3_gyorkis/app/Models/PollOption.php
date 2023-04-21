<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PollOption extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'description',
      'number_of_answers'
    ];

    public function poll(): BelongsTo
    {
        return $this->belongsTo(Poll::class);
    }
}
