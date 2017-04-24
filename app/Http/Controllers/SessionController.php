<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Mail\PasswordResetMail;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
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

        if (auth()->user()->status == 0 || auth()->user()->status == 1) {
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

    public function getReset() {
        return view('guest.reset');
    }

    public function postReset(Request $request) {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();
        $email_token = str_random(15);
        $user->status -= 1;
        $user->email_token = $email_token;
        $user->save();

        $data = [
            'email_token' => $email_token
        ];

        Mail::to($request->email)->queue(new PasswordResetMail($data));

        Flash::message('Email sent successfully.');
        return redirect('/login');

    }

    public function confirmReset($email_token) {
        $user = User::where('email_token', $email_token)->first();
        if (!$user)
            return redirect('error-email-token');

        $user->status = 3;
        $user->email_token = null;
        $user->save();

        auth()->login($user);
        return redirect('/setup');
    }
}
