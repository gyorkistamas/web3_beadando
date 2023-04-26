<?php

namespace App\Http\Controllers;

use App\Http\Requests\PollRequest;
use App\Models\Poll;
use App\Models\PollOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Builder\Function_;
use PHPUnit\Metadata\PostCondition;

class PollController extends Controller
{
    //

    public function create()
    {
        return view('polls.create_poll');
    }

    public function store(PollRequest $request)
    {

        $data['name'] = $request->name;
        if ($request->has('description'))
        {
            $data['description'] = $request->description;
        }
        if ($request->has('is_multiple'))
        {
            $data['is_multiple'] = 1;
        }


        $poll = Auth::user()->polls()->create($data);

        for ($i = 0; $i <= 10; $i++)
        {
            if ($request->has('answer' . $i))
            {
                $name = $request->get('answer' . $i);
                $poll->questions()->create(['name' => $name]);
            }
        }

        return redirect()->back()->with(['success' => __('Kérdőív sikeresen létrehozva!')]);
    }

    public function get(Poll $poll)
    {
        if (!$poll->running)
        {
            return view('polls.poll_closed');
        }

        return view('polls.answer_poll')->with('poll', $poll);
    }

    public function answerPoll(Poll $poll, Request $request)
    {
        $request->validate([
            'answer' => 'required'
        ]);


        if (!$poll->running)
        {
            return view('polls.poll_closed');
        }

        if ($poll->is_multiple)
        {
            foreach ($request->answer as $answer)
            {
                $answer = $poll->questions->find($answer);
                if($answer == null)
                {
                    abort(401);
                }
                $answer->number_of_answers++;
                $answer->save();
            }
        }
        else
        {
            $answer = $poll->questions->find($request->answer);
            if($answer == null)
            {
                abort(401);
            }
            $answer->number_of_answers++;
            $answer->save();
        }

        $poll->number_of_submits++;
        $poll->save();

        return redirect()->back();
    }
}
