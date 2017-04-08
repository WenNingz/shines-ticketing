<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class QueueController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('permission:queue-index')->only('index');
    }

    public function index() {
        $user = auth()->user();

        switch (Input::get('category')) {
            default :
                $posts = Post::where('status', 1)->paginate(10);
                break;
            case 'bill':
                $posts = Post::where('status', 1)
                    ->where('category', 'bill')
                    ->paginate(10);
                break;
            case 'technical':
                $posts = Post::where('status', 1)
                    ->where('category', 'technical')
                    ->paginate(10);
                break;
            case 'cs':
                $posts = Post::where('status', 1)
                    ->where('category', 'cs')
                    ->paginate(10);
                break;
            case 'other':
                $posts = Post::where('status', 1)
                    ->where('category', 'other')
                    ->paginate(10);
                break;
        }
        if ($user->hasRole('super-admin')) {
            return view('super-admin.support-list', [
                'posts' => $posts,
                '_active' => 'ticket-list',
                'category' => Input::get('category')
            ]);
        }
        if ($user->hasRole('admin')) {
            return view('admin.support-list', [
                'posts' => $posts,
                '_active' => 'ticket-list',
                'category' => Input::get('category')
            ]);
        }
    }
}
