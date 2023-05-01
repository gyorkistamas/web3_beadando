<?php

namespace App\Http\Livewire;

use App\Models\Poll;
use Livewire\Component;

class PollDataWire extends Component
{

    public Poll $poll;

    public bool $isUpdate = false;

    protected $listeners = ['update' => 'reload'];

    public function reload()
    {
        $this->poll = $this->poll->refresh();
    }

    public function reopenPoll()
    {
        $this->poll->running = true;
        $this->poll->save();
        $this->isUpdate = true;
        $this->dispatchBrowserEvent('alert', [
            'type' => 'opened'
        ]);
        //$this->render();
    }

    public function closePoll()
    {
        $this->poll->running = false;
        $this->poll->save();
        $this->isUpdate = true;
        $this->dispatchBrowserEvent('alert', [
            'type' => 'closed'
        ]);
       // $this->render();
    }

    public function deletePoll()
    {
        $this->poll->delete();
        $this->dispatchBrowserEvent('alert', [
            'type' => 'deleted'
        ]);
        $this->emit('pollListUpdate');
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
