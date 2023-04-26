<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PollOptions extends Component
{

    public $count = 1;

    public function increase(): void
    {
        if ($this->count < 10)
        {
            $this->count += 1;
        }
    }

    public function decrease(): void
    {
        if ($this->count > 1)
        {
            $this->count -= 1;
        }
    }
    public function render()
    {
        return view('livewire.poll-options');
    }
}
