<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Post;
use App\Reply;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('permission:ticket-index')->only('index');
        $this->middleware('permission:ticket-create')->only('create');
        $this->middleware('permission:ticket-submit')->only('submit');
        $this->middleware('permission:ticket-show')->only('show');
    }

    public function index() {
        $user = auth()->user();

        if ($user->hasRole('super-admin')) {
            return view('super-admin.support-ticket');
        }
        if ($user->hasRole('admin')) {
            return view('admin.support-ticket');
        }
        if ($user->hasRole('attendee')) {
            return view('attendee.support-ticket');
        }
    }

    public function create() {
        return view('attendee.support-new-ticket');
    }

    public function submit(PostRequest $request) {
        $user = auth()->user();

        $post = Post::create([
            'title' => request('title'),
            'message' => request('message'),
            'status' => 1,
            'user_id' => $user->id
        ]);

        $ticket_id = Carbon::now()->format('ymd-hi-') . substr('000000' . $post->id, -7);
        $post->ticket_number = $ticket_id;
        $post->save();

        Reply::create([
            'post_id' => $post->id,
            'message' => request('message'),
            'user_id' => $user->id
        ]);
        return redirect('/ticket-details/' . $post->ticket_number);
    }

    public function show($ticket_number) {
        $user = auth()->user();

        try {
            $post = Post::where('ticket_number', $ticket_number)
                ->where('user_id', $user->id)
                ->firstOrFail();
            return view('attendee.support-ticket-details', [
                'post' => $post
            ]);
        } catch (ModelNotFoundException $e) {
            abort(404);
        }

    }
}
