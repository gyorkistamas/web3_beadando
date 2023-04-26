<?php

namespace App\Http\Controllers;

use App\Http\Requests\PollRequest;
use App\Models\Poll;
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

    }
}
