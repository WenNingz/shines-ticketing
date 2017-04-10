<?php

namespace App\Http\Controllers\Event;

use App\Event;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

class SyncController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('permission:sync-index')->only('index');
        $this->middleware('permission:sync-show')->only('show');
        $this->middleware('permission:sync-update')->only('update');
    }

    public function index() {
        $user = auth()->user();
        $events = Event::where('status', 1)->paginate(10);
        if ($user->hasRole('super-admin'))
            return view('super-admin.event-sync', [
                '_active' => 'sync-event',
                'events' => $events
            ]);
        if ($user->hasRole('admin')) {
            return view('admin.event-sync', [
                '_active' => 'sync-event',
                'events' => $events
            ]);
        }
    }

    public function show($id) {
        $user = auth()->user();
        try {
            $event = Event::where('id', $id)->first();
            if ($user->hasRole('super-admin')) {
                return view('super-admin.event-edit', [
                    '_active' => 'sync-event',
                    'event' => $event
                ]);
            }
            if ($user->hasRole('admin')) {
                return view('admin.event-edit', [
                    '_active' => 'sync-event',
                    'event' => $event
                ]);
            }
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }

    public function update($id) {
        try {
            $event = Event::where('id', $id)->firstOrFail();

            if (Input::get('reject') == "true") {
                $event->status = 0;
                $event->save();
                return redirect('/sync-events')->with('status', 'Event rejected successfully');
            }

            $event->description = Input::get('description');
            if (Input::get('publish') == 'true') {
                $event->status = 2;
            }
            $event->save();

            if (Input::get('publish') == 'true') {
                return redirect('/sync-events')->with('status', 'Event published successfully');
            }
            return redirect('/edit-event/' . $event->id)->with('status', 'Event saved successfully');
        } catch (ModelNotFoundException $e) {
            abort(404);
        } catch (\Exception $e) {
            Log::error($e);
            abort(500);
        }
    }
}
