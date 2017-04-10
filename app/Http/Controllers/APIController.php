<?php

namespace App\Http\Controllers;

use App\Event;
use App\Ticket;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class APIController extends Controller
{
    public function webhook() {
        $data = \GuzzleHttp\json_decode(Input::all()[0]);
        Log::info(Input::all()[0]);
        $filename = 'storage/' . Carbon::now()->timestamp . '.jpg';
        Image::make('http://192.168.1.4:8000' . $data->image)->save($filename);

        $event = Event::create([
            'name' => $data->name,
            'description' => $data->description,
            'image' => '/'. $filename,
            'date' => $data->date,
            'venue' => $data->venue
        ]);

        foreach ($data->types as $type) {
            Ticket::create([
                'name' => $type->name,
                'description' => $type->description,
                'event_id' => $event->id,
                'price' => $type->price,
                'total' => $type->ticket_count,
                'available' => $type->ticket_available
            ]);
        }


    }
}
