<?php

namespace App\Http\Controllers;

use App\Event;
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
        Event::create([
            'name' => $data->name,
            'description' => $data->description,
            'image' => $data->image,
            'date' => $data->date,
            'venue' => $data->venue
        ]);

        $filename = Carbon::now()->timestamp . '.jpg';

        Image::make('http://192.168.100.7:8000' . $data->image)->save('storage/' . $filename);
    }
}
