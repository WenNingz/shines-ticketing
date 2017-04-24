<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Laracasts\Flash\Flash;

class SessionController extends Controller
{
    public function __construct() {
        $this->middleware('guest', ['except' => 'destroy']);
    }

    public function index() {

        return view('guest.login');
    }

    public function submit(LoginRequest $request) {

        if (!auth()->attempt([
            'email' => request('email'),
            'password' => request('password'),
        ])
        ) {
            return back()
                ->withErrors([
                    'message' => 'Please check your credentials and try again'
                ]);
        }

        if(auth()->user()->status == 0 || auth()->user()->status == 1) {
            auth()->logout();
            return back()
                ->withErrors([
                    'message' => 'Please check your credentials and try again'
                ]);
        }

        return redirect('/dashboard');

    }

    public function destroy() {
        auth()->logout();
        return redirect('/login');
    }
}
