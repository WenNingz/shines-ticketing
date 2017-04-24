<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SetupController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('guest.setup');
    }

    public function submit(Request $request) {
        $this->validate($request, [
            'password' => 'required|min:8|confirmed'
        ]);

        $user = auth()->user();
        $user->password = bcrypt(request('password'));
        $user->save();

        return redirect('/dashboard');
    }
}
