<?php

namespace App\Http\Controllers;

use Illuminate\Container\RewindableGenerator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {

    }
}
