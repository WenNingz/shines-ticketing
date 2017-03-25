<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class AttendeeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('permission:user-attendee-index')->only('index');
        $this->middleware('permission:user-attendee-edit')->only('edit');
    }

    public function index() {
        $user = auth()->user();
        $role = Role::where('name', 'attendee')->first();
        $users = $role->users;

        if ($user->hasRole('super-admin'))
            return view('super-admin.manage-attendee', [
                'users' => $users
            ]);
        if ($user->hasRole('admin'))
            return view('admin.manage-attendee', [
                'users' => $users
            ]);
    }

    public function edit() {
        $user = User::find(Input::get('user_id'));
        if ($user->hasRole('attendee')) {
            switch (Input::get('action')) {
                case 'suspend':
                    if ($user->status == 2 || $user->status == 3) {
                        $user->status -= 2;
                        $user->save();
                    }
                    break;
                case 'activate':
                    if ($user->status != 2 || $user->status != 3) {
                        $user->status += 2;
                        $user->save();
                    }
                    break;
            }
        }
        return response()->json([
            'success' => true
        ]);
    }
}
