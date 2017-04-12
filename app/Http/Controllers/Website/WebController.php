<?php

namespace App\Http\Controllers\Website;

use App\Event;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

class WebController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->only('checkout');
    }

    public function index() {
        $events = Event::where('status', 2)
            ->where('date', '>=', Carbon::now())->paginate(12);
        return view('guest.home', [
            'events' => $events
        ]);
    }

    public function browse() {
        $q = Input::get('query');
        $events = Event::where('status', 2)
            ->where('date', '>=', Carbon::now())
            ->where(function ($query) use ($q) {
                $query->where('name', 'like', '%' . $q . '%')
                    ->orWhere('venue', 'like', '%' . $q . '%')
                    ->orWhere('date', 'like', '%' . $q . '%');
            })->paginate(10);
        return view('guest.browse-events', [
            'events' => $events,
            'query' => $q
        ]);
    }

    public function show($id) {
        try {
            $event = Event::find($id);
            return view('guest.event-detail', [
                'event' => $event
            ]);

        } catch (ModelNotFoundException $e) {
            Log::error($e);
            abort(404);
        }
    }

    public function checkout($id) {
        try {
            DB::beginTransaction();

            $event = Event::findOrFail($id);
            foreach ($event->tickets as $ticket) {
//                dd(Input::get('qty_' . $ticket->id));
                $ticket->available -= Input::get('qty_' . $ticket->id);
                $ticket->save();
                DB::commit();
            };

            return redirect('view-event/'. $id);


        } catch (ModelNotFoundException $e) {
            Log::error($e);
            abort(404);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e);
            abort(500);
        }
    }


}
