<?php

namespace App\View\Components;

use App\Models\Poll;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PollDataCard extends Component
{
    /**
     * Create a new component instance.
     */
    public Poll $poll;

    public function __construct(Poll $poll)
    {
        $this->poll = $poll;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.poll-data-card');
    }
}
