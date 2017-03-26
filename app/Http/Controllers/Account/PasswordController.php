<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class PasswordController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('permission:password-index')->only('index');
        $this->middleware('permission:password-edit')->only('edit');
    }

    public function index() {
        $user = auth()->user();

        if ($user->hasRole('super-admin')) {
            return view('super-admin.password');
        }
        if ($user->hasRole('admin')) {
            return view('admin.password');
        }
        if ($user->hasRole('attendee')) {
            return view('attendee.password');
        }
    }

    public function edit(Request $request) {
        $user = auth()->user();

        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        if(Hash::check(Input::get('current_password'), $user->password)) {
            $user->password = bcrypt(Input::get('password'));
            $user->save();
            return redirect('/change-password')->with('status', 'Password changed!');
        }
        return redirect('/change-password')->withErrors(['message' => 'Current password is incorrect']);
    }
}
