<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PollController extends Controller
{
    //

    public function create()
    {
        return view('polls.create_poll');
    }

    public function store()
    {

    }
}
