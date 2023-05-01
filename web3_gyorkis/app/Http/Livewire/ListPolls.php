<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
class ListPolls extends Component
{
    use WithPagination;

    protected $listeners = ['pollListUpdate' => 'render'];
    protected $paginationTheme = 'bootstrap';

    public $searchText = "";

    public $onlyRunning = false;

    public function updateSearch(): void
    {
        $this->resetPage();
    }

    public  function update()
    {
        $this->emit('update');
        $this->resetPage();
    }

    public function render()
    {
        if ($this->onlyRunning)
        {
            return view('livewire.list-polls')->with([
                'polls' => Auth::user()->polls()
                        ->where('name', 'like', '%'.$this->searchText.'%')
                        ->where('running', 1)
                        ->paginate(12)
            ]);
        }

        return view('livewire.list-polls')->with([
            'polls' => Auth::user()->polls()
                        ->where('name', 'like', '%'.$this->searchText.'%')
                        ->paginate(12)
        ]);
    }
}
