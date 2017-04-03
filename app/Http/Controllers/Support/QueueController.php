<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('permission:queue-index')->only('index');
    }

    public function index() {
        $user = auth()->user();
        $posts = Post::where('status', 1)->paginate(10);

        if ($user->hasRole('super-admin')) {
            return view('super-admin.support-list', [
                'posts' => $posts,
                '_active' => 'ticket-list'
            ]);
        }
        if ($user->hasRole('admin')) {
            return view('admin.support-list', [
                'posts' => $posts,
                '_active' => 'ticket-list'
            ]);
        }
    }
}
