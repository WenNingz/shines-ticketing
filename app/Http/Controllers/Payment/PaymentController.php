<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Purchase;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('permission:payment-index')->only('index');
        $this->middleware('permission:payment-show')->only('show');
    }

    public function index() {
        $user = auth()->user();
        $purchases = Purchase::orderBy('created_at', 'desc')->paginate(10);

        if ($user->hasRole('super-admin')) {
            return view('super-admin.payments', [
                '_active' => 'payments',
                'purchases' => $purchases
            ]);
        }
        if ($user->hasRole('admin')) {
            return view('admin.payments', [
                '_active' => 'payments',
                'purchases' => $purchases
            ]);
        }
        if ($user->hasRole('attendee')) {
            $purchases = Purchase::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);
            return view('attendee.payments', [
                '_active' => 'payments',
                'purchases' => $purchases
            ]);
        }
    }

    public function show($id) {
        try {
            $user = auth()->user();
            $purchase = Purchase::findOrFail($id);

            if ($user->hasRole('super-admin')) {
                return view('super-admin.payment-details', [
                    '_active' => 'payments',
                    'purchase' => $purchase
                ]);
            }
            if ($user->hasRole('admin')) {
                return view('admin.payment-details', [
                    '_active' => 'payments',
                    'purchase' => $purchase
                ]);
            }
            if ($user->hasRole('attendee')) {
                $purchase = Purchase::where('id', $id)
                    ->where('user_id', $user->id)->first();
                return view('attendee.payment-details', [
                    '_active' => 'payments',
                    'purchase' => $purchase
                ]);
            }
        } catch (ModelNotFoundException $e) {
            Log::error($e);
            abort(404);
        }

    }
}
