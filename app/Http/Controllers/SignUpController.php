<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignUpRequest;
use App\Mail\VerificationMail;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Mail;
use Laracasts\Flash\Flash;

class SignUpController extends Controller
{
    public function __construct() {
        $this->middleware('guest', ['except' => 'confirm']);
    }

    public function index() {
        return view('guest.signup');
    }

    public function submit(SignUpRequest $request) {
//        dd($request->all());
        $email_token = str_random(15);
        //Create and save user
        $user = User::create([
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'email_token' => $email_token
        ]);

        $attendee = Role::where('name', 'attendee')->first();
        $user->attachRole($attendee);

        $data = [
            'email_token' => $email_token
        ];

        Mail::to($request->email)->queue(new VerificationMail($data));

        Flash::message('Thanks for signing up! Please check your email.');

        return redirect('/');
    }

    public function confirm($email_token) {
        if (!$email_token)
            return redirect('/error-email-token');


        $user = User::where('email_token', $email_token)->first();
        if (!$user)
            return redirect('error-email-token');

        $user->status = 3;
        $user->email_token = null;
        $user->save();

        if ($user->hasRole('attendee')){
        Flash::message('You have successfully verified your account.');

        return redirect('/login');
        }

        if ($user->hasRole('admin')){
            auth()->login($user);
            return redirect('/setup');
        }
    }
}
