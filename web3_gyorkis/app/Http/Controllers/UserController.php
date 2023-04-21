<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Container\RewindableGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required',
            'email' => ['required', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed']
        ]);

        $fields['password'] = Hash::make($fields['password']);

        User::create($fields);

        return redirect()->back()->with(['success' => 'Registration successful!']);
    }
}
