<?php

namespace App\Http\Controllers;

use App\Event;
use App\Mail\RefundMail;
use App\Purchase;
use App\Tag;
use App\Ticket;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;

class APIController extends Controller
{
    public function webhook()
    {
        $data = \GuzzleHttp\json_decode(Input::all()[0]);
        Log::info(Input::all()[0]);
        $filename = null;
        $filename300 = null;

        if ($data->image != null) {
            $filename = 'storage/' . Carbon::now()->timestamp . '.jpg';
            $filename300 = 'storage/' . Carbon::now()->timestamp . '-300x200' . '.jpg';
            Image::make(env('API_ADDRESS') . $data->image)->save($filename);
            Image::make(env('API_ADDRESS') . $data->image)->fit(300, 200)->save($filename300);
            $filename = '/' . $filename;
            $filename300 = '/' . $filename300;
        }

        $event = Event::updateOrCreate([
            'ext_id' => $data->id
        ], ['name' => $data->name,
            'description' => $data->description,
            'image_ori' => $filename,
            'image_card' => $filename300,
            'date' => $data->date,
            'venue' => $data->venue,
        ]);

        $event->tags()->delete();

        foreach ($data->tags as $tag) {
            Tag::create([
                'name' => $tag,
                'event_id' => $event->id
            ]);
        }

        foreach ($data->types as $type) {
            Ticket::firstOrCreate(['ext_id' => $type->id], [
                'name' => $type->name,
                'description' => $type->description,
                'event_id' => $event->id,
                'price' => $type->price,
                'total' => $type->ticket_count,
                'available' => $type->ticket_available,
            ]);
        }
    }


    public function approved($purchase_id)
    {
        try {
            $purchase = Purchase::where('purchase_id', $purchase_id)->firstOrFail();
            $purchase->refunded_at = Carbon::now();
            $purchase->save();

            Mail::to($purchase->user->email)->queue(new RefundMail());
        } catch (ModelNotFoundException $e) {
            Log::error($e);
            abort(500);
        }

        return response()->json();
    }

    public function declined($purchase_id)
    {
        try {
            $purchase = Purchase::where('purchase_id', $purchase_id)->firstOrFail();
            $purchase->refund_at = null;
            $purchase->save();

            //send email
        } catch (ModelNotFoundException $e) {
            Log::error($e);
            abort(500);
        }

        return response()->json();
    }

    public function used($purchase_id, $number)
    {
        try {
            $purchase = Purchase::where('purchase_id', $purchase_id)->firstOrFail();
            foreach ($purchase->items as $item) {
                foreach ($item->passes as $pass){
                    if($pass->number == $number){

                        $pass->used_on = Carbon::now();
                        $pass->save();

                        return response()->json();
                    }
                }
            }
            $purchase->save();

            //send email
        } catch (ModelNotFoundException $e) {
            Log::error($e);
            abort(500);
        }

        return response()->json();
    }
}
