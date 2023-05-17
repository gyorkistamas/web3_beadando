<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\PollAnswer;
use Illuminate\Http\Request;

class AnswerPollController extends Controller
{
    public function get(Poll $poll, Request $request)
    {
        if (!$this->CanAnswer($poll, $request))
        {
            return redirect()
                ->route('polls.result', $poll->id)
                ->with(['cantAnswer' => 'You have already answered this question!']);
        }

        if (!$poll->running)
        {
            return view('polls.poll_closed');
        }

        return view('polls.answer_poll')->with('poll', $poll);
    }

    public function answerPoll(Poll $poll, Request $request)
    {
        if (!$this->CanAnswer($poll, $request))
        {
            return redirect()
                ->route('polls.result', $poll->id)
                ->with(['cantAnswer' => 'You have already answered this question!']);
        }

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

        $answerId = [];

        if(auth()->user())
        {
            $answerId['user_id'] = auth()->user()->id;
        }
        else
        {
            $answerId['ip_address'] = $request->ip();
        }
        $answerId['poll_id'] = $poll->id;

        PollAnswer::create($answerId);

        $poll->save();
        return redirect()->route('polls.result', $poll->id)->with('answered', __('Válaszát rögzítettük'));
    }

    private function CanAnswer(Poll $poll, Request $request) : bool
    {
        $answers = 0;
        if (auth()->user())
        {
            $answers = $poll->fills()->where('user_id', auth()->user()->id)->count();
        }
        else
        {
            $answers = $poll->fills()->where('ip_address', $request->ip())->count();
        }

        return $answers == 0;
    }
}
