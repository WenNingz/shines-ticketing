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
        $search = Input::get('query');

        switch (Input::get('status')) {
            default:
                $users = $role->users()->where(function ($query) use ($search) {
                    $query->where('first_name', 'like', '%' . $search . '%')
                        ->orWhere('last_name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                })->paginate(10);
                break;
            case 'active':
                $users = $role->users()->where(function ($query) use ($search) {
                    $query->where('status', 2)
                        ->orWhere('status', 3);
                })->where(function ($query) use ($search) {
                    $query->where('first_name', 'like', '%' . $search . '%')
                        ->orWhere('last_name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                })->paginate(10);
                break;
            case 'inactive':
                $users = $role->users()->where(function ($query) use ($search) {
                    $query->where('status', '!=', 2)
                        ->where('status', '!=', 3)
                        ->where(function ($query) use ($search) {
                            $query->where('first_name', 'like', '%' . $search . '%')
                                ->orWhere('last_name', 'like', '%' . $search . '%')
                                ->orWhere('email', 'like', '%' . $search . '%');
                        });
                })->paginate(10);
                break;
        }

        if ($user->hasRole('super-admin'))
            return view('super-admin.manage-attendee', [
                'users' => $users,
                'status' => Input::get('status'),
                'query' => Input::get('query'),
                '_active' => 'manage-attendee'
            ]);
        if ($user->hasRole('admin'))
            return view('admin.manage-attendee', [
                'users' => $users,
                'status' => Input::get('status'),
                'query' => Input::get('query'),
                '_active' => 'manage-attendee'
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
                    if ($user->status != 2 && $user->status != 3) {
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
