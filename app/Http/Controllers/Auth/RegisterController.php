<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendWelcomeEmail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create(){
        return view('auth.register');
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|min:4|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // dispatch(send) the job to the queue
        SendWelcomeEmail::dispatch($user);
        Auth::login($user);

        return to_route('notes.index');
    }
}
