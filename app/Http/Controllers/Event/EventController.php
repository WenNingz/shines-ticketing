<?php

namespace App\Http\Controllers\Event;

use App\Event;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Exception;

class EventController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('permission:event-index')->only('index');
        $this->middleware('permission:event-show')->only('show');
        $this->middleware('permission:event-update')->only('update');
    }

    public function index() {
        $user = auth()->user();
        $q = Input::get('query');

        switch (Input::get('status')) {
            default:
                $events = Event::where('status', 2)
                    ->where(function ($query) use ($q) {
                        $query->where('name', 'like', '%' . $q . '%')
                            ->orWhere('description', 'like', '%' . $q . '%')
                            ->orWhere('venue', 'like', '%' . $q . '%')
                            ->orWhere('date', 'like', '%' . $q . '%');
                    })->paginate(10);
                break;
            case 'ongoing':
                $events = Event::where('status', 2)
                    ->where(function ($query) use ($q) {
                        $query->where('name', 'like', '%' . $q . '%')
                            ->orWhere('description', 'like', '%' . $q . '%')
                            ->orWhere('venue', 'like', '%' . $q . '%')
                            ->orWhere('date', 'like', '%' . $q . '%');
                    })
                    ->where('date', '>=', Carbon::now())
                    ->paginate(10);
                break;
            case 'complete':
                $events = Event::where('status', 2)
                    ->where(function ($query) use ($q) {
                        $query->where('name', 'like', '%' . $q . '%')
                            ->orWhere('description', 'like', '%' . $q . '%')
                            ->orWhere('venue', 'like', '%' . $q . '%')
                            ->orWhere('date', 'like', '%' . $q . '%');
                    })
                    ->where('date', '<=', Carbon::now())
                    ->paginate(10);
                break;
        }

        if ($user->hasRole('super-admin'))
            return view('super-admin.event-list', [
                '_active' => 'event-list',
                'query' => $q,
                'status' => Input::get('status'),
                'events' => $events,
            ]);
        if ($user->hasRole('admin')) {
            return view('admin.event-list', [
                '_active' => 'event-list',
                'query' => $q,
                'status' => Input::get('status'),
                'events' => $events
            ]);
        }
    }

    public function show($id) {
        $user = auth()->user();
        try {
            $event = Event::find($id);
            if ($user->hasRole('super-admin')) {
                return view('super-admin.event-detail', [
                    '_active' => 'event-list',
                    'event' => $event
                ]);
            }
            if ($user->hasRole('admin')) {
                return view('admin.event-detail', [
                    '_active' => 'event-list',
                    'event' => $event
                ]);
            }
        } catch (ModelNotFoundException $e) {
            Log::error($e);
            abort(404);
        }
    }

    public function update($id) {
        try {
            $event = Event::where('id', $id)->firstOrFail();

            if (Input::get('reject') == "true") {
                $event->status = 0;
                $event->save();
                return redirect('/sync-event')->with('status', 'Event rejected successfully');
            }

            $event->description = Input::get('description');
            if (Input::get('publish') == 'true') {
                $event->status = 2;
            }
            $event->save();

            if (Input::get('publish') == 'true') {
                return redirect('/sync-event')->with('status', 'Event published successfully');
            }
            return redirect('/edit-event/' . $event->id)->with('status', 'Event saved successfully');
        } catch (ModelNotFoundException $e) {
            abort(404);
        } catch (Exception $e) {
            Log::error($e);
            abort(500);
        }
    }
}
