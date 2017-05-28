<?php

namespace App\Http\Controllers;

use App\Event;
use App\Item;
use App\Pass;
use App\Purchase;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('permission:dashboard-index')->only('index');
        $this->middleware('permission:dashboard-show')->only('show');
        $this->middleware('permission:dashboard-view')->only('view');
        $this->middleware('permission:dashboard-refund')->only('refund');
    }

    public function index() {
        $user = auth()->user();

        if ($user->hasRole('attendee')) {
            $purchases = $user->purchases()->where('refund_at', null)->paginate(10);
            $refunds = $user->purchases()->where('refund_at', '!=', null)
                ->where('refunded_at', null)->paginate(10);
            return view('attendee.dashboard', [
                '_active' => 'dashboard',
                'purchases' => $purchases,
                'refunds' => $refunds
            ]);
        } else {
            $from_date = Carbon::now()->startOfWeek();
            $till_date = Carbon::now()->startOfWeek()->addDays(7);
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

    public function view($pass_id) {
        try {
            $pass = Pass::findOrFail($pass_id);
            return view('attendee.purchase-ticket', [
                '_active' => 'dashboard',
                'pass' => $pass
            ]);
        } catch (ModelNotFoundException $e) {
            Log::error($e);
            abort(404);
        }
    }

    public function refund($payment_id) {
        $user = auth()->user();

        if ($user->hasRole('attendee')) {
            try {
                $purchase = Purchase::where('purchase_id', $payment_id)->firstOrFail();
                $purchase->refund_at = Carbon::now();
                $purchase->save();
            } catch (ModelNotFoundException $e) {
                Log::error($e);
                abort(404);
            }

            $client = new \GuzzleHttp\Client();
            $client->request('GET', env('API_ADDRESS') . '/api/refundRequest/' . env('API_KEY') . '/' . $payment_id);

            return back();
        }
    }
}
