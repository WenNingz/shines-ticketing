<?php

namespace App\Http\Controllers\Website;

use App\Event;
use App\Http\Controllers\Controller;
use App\Item;
use App\Pass;
use App\Purchase;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

class WebController extends Controller
{

    public function index() {
        $events = Event::where('status', 2)
            ->where('date', '>=', Carbon::now())
            ->orderBy('date', 'asc')->take(4)->get();
        return view('guest.home', [
            'events' => $events
        ]);
    }

    public function browse() {
        $q = Input::get('query');
        $start_date = Input::get('start_date');
        $end_date = Input::get('end_date');

        $events = Event::where(function ($query) use ($q) {
            $query->where('status', 2)
                ->where('date', '>=', Carbon::now())
                ->where(function ($query) use ($q) {
                    $query->where('name', 'like', '%' . $q . '%')
                        ->orWhere('venue', 'like', '%' . $q . '%')
                        ->orWhereHas('tags', function ($query) use ($q) {
                            $query->where('name', 'like', '%' . $q . '%');
                        });
                });
        });

        if ($start_date != null) {
//            $start_date = Carbon::parse($start_date)->format('Y-m-d');
            $events = $events->where('date', '>=', $start_date);
        }
        if ($end_date != null) {
//            $end_date = Carbon::parse($end_date)->format('Y-m-d');
            $events = $events->where('date', '<=', $end_date);
        }

        $events = $events->orderBy('date', 'asc')->paginate(10);
        return view('guest.browse-events', [
            'events' => $events,
            'query' => $q,
            'start_date' => $start_date,
            'end_date' => $end_date
        ]);
    }

    public function show($id) {
        try {
            $event = Event::findOrFail($id);
            return view('guest.event-detail', [
                'event' => $event
            ]);

        } catch (ModelNotFoundException $e) {
            Log::error($e);
            abort(404);
        }
    }
}
