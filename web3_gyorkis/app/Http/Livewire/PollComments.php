<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Poll;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class PollComments extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public Poll $poll;
    public $comment;

    protected $listeners = ['new' => '$refresh'];

    protected $rules = [
        'comment' => 'required|min:5',
    ];

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function saveComment(): void
    {
        $this->validate($this->rules);

        $newComment = new Comment(['comment_text' => $this->comment]);

        $newComment = $newComment->user()->associate(Auth::user());
        $newComment = $newComment->poll()->associate($this->poll);

        $this->poll->comments()->save($newComment);

        $this->comment = "";

        $this->emit('new');
    }

    public function render()
    {
        return view('livewire.poll-comments')->with(
            ['comments' => $this->poll->comments()->orderBy('created_at', 'desc')->paginate(5)]
        );
    }
}
