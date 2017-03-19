<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignUpRequest;
use App\User;
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
        $email_token = str_random(10);
        //Create and save user
        $user = User::create([
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'email_token' => $email_token
        ]);

        $data = [
            'email_token' => $email_token
        ];
        Mail::send('email.verify', $data, function ($message) use ($request) {

            $message->from(env('MAIL_USERNAME'), 'Shines Service Admin');
            $message->to($request->email)->subject('Verify Email Address');
        });

        Flash::message('Thanks for signing up! Please check your email.');

        return redirect('home');
    }

    public function confirm($email_token) {
        if (!$email_token)
            return redirect('error-email-token');


        $user = User::where('email_token', $email_token)->first();
        if (!$user)
            return redirect('error-email-token');

        $user->verified = 1;
        $user->email_token = null;
        $user->save();

        Flash::message('You have successfully verified your account.');

        return redirect('login');
    }
}
