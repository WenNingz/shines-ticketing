<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AdminRequest;
use Illuminate\Support\Facades\Mail;
use App\Role;
use App\User;


class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('permission:user-admin-index')->only('index');
        $this->middleware('permission:user-admin-create')->only('create');
    }

    public function index() {
        $role = Role::where('name', 'admin')->first();
        $users = $role->users;
        return view('super-admin.manage-admin', compact('users'));
    }

    public function create() {
        return view('super-admin.manage-admin-add');
    }

    public function submit(AdminRequest $request) {
        $email_token = str_random(15);

        $user = User::create([
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'email' => request('email'),
            'password' => bcrypt(str_random(8)),
            'email_token' => $email_token
        ]);

        $admin = Role::where('name', 'admin')->first();
        $user->attachRole($admin);

        $data = [
            'email_token' => $email_token
        ];

        Mail::send('email.verify', $data, function ($message) use ($request) {

            $message->from(env('MAIL_USERNAME'), 'Shines Service');
            $message->to($request->email)->subject('Verify Email Address');
        });

        return redirect('/manage-admin');
    }

}
