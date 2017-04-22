<?php

namespace App\Http\Controllers;

use App\Event;
use App\Pass;
use App\Purchase;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('permission:dashboard-index')->only('index');
        $this->middleware('permission:dashboard-show')->only('show');
    }

    public function index() {
        $user = auth()->user();

        if ($user->hasRole('attendee')) {
            $purchases = $user->purchases()->paginate(10);
            return view('attendee.dashboard', [
                '_active' => 'dashboard',
                'purchases' => $purchases
            ]);
        }
        else {
            $from_date = Carbon::now()->subDay()->startOfWeek()->toDateString();
            $till_date = Carbon::now()->subDay()->startOfWeek()->addDays(7);
            $total_events = Event::whereBetween('date', [$from_date, $till_date])->count();
            $ticket_sold = Pass::whereBetween('created_at', [$from_date, $till_date])->count();
            $sales = Pass::whereBetween('created_at', [$from_date, $till_date])->sum('price');

            if ($user->hasRole('super-admin')) {
                return view('super-admin.dashboard', [
                    '_active' => 'dashboard',
                    'total_events' => $total_events,
                    'ticket_sold' => $ticket_sold,
                    'sales' => $sales
                ]);
            }
            if ($user->hasRole('admin')) {
                return view('admin.dashboard', [
                    '_active' => 'dashboard',
                    'total_events' => $total_events,
                    'ticket_sold' => $ticket_sold,
                    'sales' => $sales
                ]);
            }
        }
    }

    public function show($id) {
        $purchase = Purchase::find($id);
        return view('attendee.purchase-details', [
            '_active' => 'dashboard',
            'purchase' => $purchase
        ]);
    }
}
