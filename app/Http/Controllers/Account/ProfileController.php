<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class ProfileController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('permission:profile-index')->only('index');
        $this->middleware('permission:profile-edit')->only('edit');
    }

    public function index() {
        $user = auth()->user();
        if ($user->hasRole('super-admin')) {
            return view('super-admin.profile', [
                'user' => $user
            ]);
        }
        if ($user->hasRole('admin')) {
            return view('admin.profile', [
                'user' => $user
            ]);
        }
        if ($user->hasRole('attendee')) {
            return view('attendee.profile', [
                'user' => $user
            ]);
        }
    }

    public function edit(Request $request) {
        $user = auth()->user();

        $this->validate($request, [
            'first_name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        try {
            User::where('id', '!=', $user->id)
                ->where('email', Input::get('email'))
                ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $user->first_name = Input::get('first_name');
            $user->last_name = Input::get('last_name');
            $user->email = Input::get('email');
            $user->email_token = str_random(15);
            if ($user->status == 3) {
                $user->status -= 1;
            }
            if (Hash::check(Input::get('password'), $user->password)) {
                $user->save();
                //send mail
                return redirect('/profile')->with('status', 'Profile Updated!');
            }
            return redirect('/profile')->withErrors(['message' => 'Invalid Password']);
        }
        return redirect('/profile')->withErrors(['message' => 'Email already taken']);
    }
}
