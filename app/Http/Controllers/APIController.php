<?php

namespace App\Http\Controllers;

use App\Event;
use App\Tag;
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
        $filename = null;

        if ($data->image != null) {
            $filename = 'storage/' . Carbon::now()->timestamp . '.jpg';
            $filename300 = 'storage/' . Carbon::now()->timestamp. '-300x200' . '.jpg';
            Image::make('http://192.168.100.13:8000' . $data->image)->save($filename);
            Image::make('http://192.168.100.13:8000' . $data->image)->fit(300,200)->save($filename300);
            $filename = '/' . $filename;
            $filename300 = '/' . $filename300;
        }

        $event = Event::create([
            'name' => $data->name,
            'description' => $data->description,
            'image_ori' => $filename,
            'image_card' => $filename300,
            'date' => $data->date,
            'venue' => $data->venue,
            'ext_id' => $data->id
        ]);

        foreach ($data->tags as $tag) {
            Tag::create([
                'name' => $tag,
                'event_id' => $event->id
            ]);
        }

        foreach ($data->types as $type) {
            Ticket::create([
                'name' => $type->name,
                'description' => $type->description,
                'event_id' => $event->id,
                'price' => $type->price,
                'total' => $type->ticket_count,
                'available' => $type->ticket_available,
                'ext_id' => $type->id
            ]);
        }


    }
}
