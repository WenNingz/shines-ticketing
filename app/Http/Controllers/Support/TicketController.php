<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Post;
use App\Reply;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('permission:ticket-index')->only('index');
        $this->middleware('permission:ticket-create')->only('create');
        $this->middleware('permission:ticket-submit')->only('submit');
        $this->middleware('permission:ticket-show')->only('show');
        $this->middleware('permission:ticket-store')->only('store');
        $this->middleware('permission:ticket-close')->only('close');
    }

    public function index() {
        $user = auth()->user();

        if ($user->hasRole('super-admin')) {
            $posts = Post::where('admin_id', $user->id)->paginate(10);
            return view('super-admin.support-ticket', [
                'posts' => $posts,
                '_active' => 'my-tickets'
            ]);
        }
        if ($user->hasRole('admin')) {
            $posts = Post::where('admin_id', $user->id)->paginate(10);
            return view('admin.support-ticket', [
                'posts' => $posts,
                '_active' => 'my-tickets'
            ]);
        }
        if ($user->hasRole('attendee')) {
            $posts = Post::where('user_id', $user->id)
                ->where('status', '!=', 0)
                ->where('status', '!=', 3)->paginate(10);
            $posts_solved = Post::where('user_id', $user->id)
                ->where('status', 0)
                ->orWhere('status', 3)->paginate(10);
            return view('attendee.support-ticket', [
                'active_posts' => $posts,
                'solved_posts' => $posts_solved,
                '_active' => 'my-tickets'
            ]);
        }
    }

    public function create() {
        return view('attendee.support-new-ticket', [
            '_active' => 'my-tickets'
        ]);
    }

    public function submit(PostRequest $request) {
        $user = auth()->user();

        try {
            DB::beginTransaction();

            $post = Post::create([
                'title' => request('title'),
                'message' => request('message'),
                'status' => 1,
                'user_id' => $user->id
            ]);

            $ticket_id = Carbon::now()->format('ymd-hi-') . substr('000000' . $post->id, -7);
            $post->ticket_number = $ticket_id;
            $post->save();

            $reply = $post->replies()->create([
                'message' => request('message'),
                'user_id' => $user->id,
            ]);

            DB::commit();

            return redirect('/ticket-details/' . $post->ticket_number);
        } catch (Exception $e) {
            DB::rollback();
            abort(500);
        }

    }

    public function show($ticket_number) {
        $user = auth()->user();

        try {
            if ($user->hasRole('attendee')) {
                $post = Post::where('ticket_number', $ticket_number)
                    ->where('user_id', $user->id)
                    ->firstOrFail();
                return view('attendee.support-ticket-details', [
                    'post' => $post,
                    'user' => $user,
                    '_active' => 'my-tickets'
                ]);
            }

            if ($user->hasRole('super-admin')) {
                $post = Post::where('ticket_number', $ticket_number)
                    ->firstOrFail();
                return view('super-admin.support-ticket-details', [
                    'post' => $post,
                    'user' => $user,
                    '_active' => 'my-tickets'
                ]);
            }

            if ($user->hasRole('admin')) {
                $post = Post::where('ticket_number', $ticket_number)
                    ->firstOrFail();
                return view('admin.support-ticket-details', [
                    'post' => $post,
                    'user' => $user,
                    '_active' => 'my-tickets'
                ]);
            }
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }

    public function store(Request $request, $ticket_number) {
        $this->validate($request, [
            'message' => 'required'
        ]);

        $user = auth()->user();
        try {
            $post = Post::where('ticket_number', $ticket_number)->firstOrFail();

            if ($user->hasRole('super-admin') or $user->hasRole('admin')) {
                Reply::create([
                    'post_id' => $post->id,
                    'message' => request('message'),
                    'user_id' => $user->id,
                    'parent_id' => $post->getParentId($post->user_id)->id
                ]);

                if ($post->admin_id == null) {
                    $post->admin_id = $user->id;
                    $post->save();
                }
                if ($post->status == 1) {
                    $post->status = 2;
                    $post->save();
                }
                return redirect('/ticket-details/' . $ticket_number);
            }

            if ($user->hasRole('attendee')) {
                Reply::create([
                    'post_id' => $post->id,
                    'message' => request('message'),
                    'user_id' => $user->id,
                ]);

                return redirect('/ticket-details/' . $ticket_number);
            }
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }

    public function close($ticket_number) {
        $user = auth()->user();

        $post = Post::where('ticket_number', $ticket_number)->first();
        $post->status = 3;
        $post->save();

        return redirect('my-tickets');
    }
}
