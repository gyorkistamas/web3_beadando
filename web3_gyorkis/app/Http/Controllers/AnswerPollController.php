<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use Illuminate\Http\Request;

class AnswerPollController extends Controller
{
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

        return redirect()->route('polls.result', $poll->id)->with('answered', __('Válaszát rögzítettük'));
    }
}
