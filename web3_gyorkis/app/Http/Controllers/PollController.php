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

        return redirect()->back()->with(['success' => __('Kérdőív sikeresen létrehozva!'), 'poll_id' => $poll->id]);
    }

    public function getResult(Poll $poll)
    {
        return view('polls.view_results')->with(['poll' => $poll]);
    }

    public function index()
    {
        return view('polls.my_polls')->with([
            'polls' => Auth::user()->polls
        ]);
    }
}
