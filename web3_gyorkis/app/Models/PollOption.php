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
      'number_of_answers'
    ];

    public function poll(): BelongsTo
    {
        return $this->belongsTo(Poll::class);
    }

    public function percentage(): float
    {
        $answers = $this->number_of_answers;
        $submits = $this->poll->number_of_submits;

        if ($answers == 0 || $submits == 0)
        {
            return 0;
        }

        return round(($answers / $submits) * 100, 2);
    }
}
