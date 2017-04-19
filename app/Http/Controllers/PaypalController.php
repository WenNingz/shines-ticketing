<?php

namespace App\Http\Controllers;

use App\Event;
use App\Pass;
use App\Purchase;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Laracasts\Flash\Flash;
use PayPal\Api\PaymentExecution;
use Paypal\Exception\PayPalConnectionException;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class PaypalController extends Controller
{
    private $_api_context;

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('permission:paypal-payment');

        $paypal_conf = Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function postPayment($id) {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        Session::put('event_id', $id);
        Session::put('qty', Input::get('qty'));

        $event = Event::findOrFail($id);
        $items = array();
        $total = 0.00;
        $total_qty = 0;

        foreach ($event->tickets as $ticket) {
            if ($ticket->available > 0) {
                $qty = Input::get('qty')[$ticket->id];
                $total_qty = $total_qty + $qty;
                if ($qty > 0) {
                    $item = new Item();
                    $item->setName($ticket->name)->setCurrency('SGD')->setQuantity($qty)->setPrice($ticket->price);
                    $total = $total + ($ticket->price * $qty);
                    array_push($items, $item);
                }
            }
        }
        if ($total_qty < 1) {
            return back()->withErrors(['message' => 'Please select ticket quantity']);
        }

        if ($total == 0.00) {
            try {
                DB::beginTransaction();
                $user = auth()->user();
                $event = Event::findOrFail($id);
                $qty = Input::get('qty')[$ticket->id];

                $purchase = Purchase::create([
                    'user_id' => $user->id
                ]);

                foreach ($event->tickets as $ticket) {
                    $item = \App\Item::create([
                        'ticket_id' => $ticket->id,
                        'purchase_id' => $purchase->id
                    ]);

                    $passes = $qty;
                    if ($passes != 0) {
                        for ($pass = 1; $pass <= $passes; $pass++) {
                            $ticket_no = uniqid();
                            Pass::create([
                                'number' => $ticket_no,
                                'item_id' => $item->id,
                                'price' => $ticket->price
                            ]);
                        }
                    }
                    $ticket->available -= $qty;
                    $ticket->save();
                };
                DB::commit();
                return redirect('/payment-history/')->with('status', 'Purchase success');

            } catch (ModelNotFoundException $e) {
                Log::error($e);
                abort(404);
            } catch (\Exception $e) {
                DB::rollback();
                Log::error($e);
                abort(500);
            }
        }

        $item_list = new ItemList();
        $item_list->setItems($items);

        $amount = new Amount();
        $amount->setCurrency('SGD')->setTotal($total);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment.status'))
            ->setCancelUrl(URL::route('payment.status'));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($this->_api_context);
        } catch (PayPalConnectionException $ex) {
            if (Config::get('app.debug')) {
//                echo "Exception: " . $ex->getMessage() . PHP_EOL;
//                $err_data = json_decode($ex->getData(), true);
//                exit;
                return back()->withErrors(['message' => 'Exception: ' . $ex->getMessage() . PHP_EOL]);
            } else {
                return back()->withErrors(['message' => 'Something went wrong, sorry for inconvenient']);
//                die('Something went wrong, sorry for inconvenient');
            }
        }

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        // add payment ID to session
        Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) {
            return Redirect::away($redirect_url);
        }
        return back()->withErrors(['message' => 'Unknown error occurred']);
    }

    public function getPaymentStatus() {
        // Get the payment ID before session clear
        $payment_id = Session::get('paypal_payment_id');

        // clear the session payment ID
        Session::forget('paypal_payment_id');

        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            return back()->withErrors(['message' => 'Payment canceled']);
        }

        $payment = Payment::get($payment_id, $this->_api_context);
        // PaymentExecution object includes information necessary
        // to execute a PayPal account payment.
        // The payer_id is added to the request query parameters
        // when the user is redirected from paypal back to your site
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        //Execute the payment
        $result = $payment->execute($execution, $this->_api_context);
        //echo '<pre>';print_r($result);echo '</pre>';exit; // DEBUG RESULT, remove it later
        if ($result->getState() == 'approved') {
            // payment made
            $event_id = Session::get('event_id');
            $qty = Session::get('qty');

            Session::forget('event_id');
            Session::forget('qty');

            try {
                DB::beginTransaction();
                $user = auth()->user();
                $event = Event::findOrFail($event_id);

                $purchase = Purchase::create([
                    'user_id' => $user->id
                ]);

                foreach ($event->tickets as $ticket) {
                    if ($ticket->available > 0) {
                        $item = \App\Item::create([
                            'ticket_id' => $ticket->id,
                            'purchase_id' => $purchase->id
                        ]);

                        $passes = $qty[$ticket->id];
                        if ($passes != 0) {
                            for ($pass = 1; $pass <= $passes; $pass++) {
                                $ticket_no = uniqid();
                                Pass::create([
                                    'number' => $ticket_no,
                                    'item_id' => $item->id,
                                    'price' => $ticket->price
                                ]);
                            }
                        }
                        $ticket->available -= $qty[$ticket->id];
                        $ticket->save();
                    }
                };
                DB::commit();
//                return redirect('/payment/' . $purchase->id);

            } catch (ModelNotFoundException $e) {
                Log::error($e);
                abort(404);
            } catch (\Exception $e) {
                DB::rollback();
                Log::error($e);
                abort(500);
            }
            return redirect('/payment-history')->with('status', 'Payment success');
        }

        return back()->withErrors(['message' => 'Payment failed']);
    }
}
