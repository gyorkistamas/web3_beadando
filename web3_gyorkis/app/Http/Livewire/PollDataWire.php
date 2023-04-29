<?php

namespace App\Http\Livewire;

use App\Models\Poll;
use Livewire\Component;

class PollDataWire extends Component
{

    public Poll $poll;

    public bool $isUpdate = false;

    public function reopenPoll()
    {
        $this->poll->running = true;
        $this->poll->save();
        $this->isUpdate = true;
        //$this->render();
    }

    public function closePoll()
    {
        $this->poll->running = false;
        $this->poll->save();
        $this->isUpdate = true;
       // $this->render();
    }

    public function paginationView()
    {
        return 'vendor.pagination.bootstrap-5';
    }

    public function render()
    {
        return view('livewire.poll-data-wire');
    }
}
