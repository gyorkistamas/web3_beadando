<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Container\RewindableGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Validation\Rule;

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


    public function login()
    {
        return view('auth.login');
    }

    public function auth(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($fields))
        {
            return redirect()->route('home');
        }

        return redirect()->back()->with('bad_credentials', 'Bad credentials');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function update()
    {
        return view('auth.update');
    }

    public function save(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore(Auth::user()->id)]
        ]);

        if ($request->has('password') && $request->password != '') {
            $pass = $request->validate([
                'password' => ['required', 'min:8', 'confirmed']
            ]);

            $fields['password'] = Hash::make($pass['password']);
        }

        $user = Auth::user();

        $user->update($fields);

        $user->save();

        return redirect()->route('edit-profile')->with('success', 'Profile saved');
    }
}
