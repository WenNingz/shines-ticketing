<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('permission:dashboard-index')->only('index');
    }

    public function index() {
        $user = auth()->user();

        if($user->hasRole('super-admin'))
            return view('super-admin.dashboard', [
                '_active' => 'dashboard'
            ]);
        if ($user->hasRole('admin'))
            return view('admin.dashboard', [
                '_active' => 'dashboard'
            ]);
        if ($user->hasRole('attendee'))
            return view('attendee.dashboard', [
                '_active' => 'dashboard'
            ]);
    }
}
