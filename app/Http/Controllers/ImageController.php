<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function store(){
        Validator::make(Input::all(), [
            'files' => 'required|mimes:jpeg,bmp,png|max:10240'
        ])->validate();

        $file = Input::file('files');
        $ext = $file->getClientOriginalExtension();
        $filename = 'storage/' . Carbon::now()->format('YmdHis') . '.' . $ext;
        $filename300 = 'storage/' . Carbon::now()->format('YmdHis') . '.' . $ext;
        Image::make($file)->save($filename);
        Image::make($file)->fit(300,200)->save($filename300);

        return response()->json(['success' => true, 'image_path' => '/' . $filename, 'image_300_path' => '/' . $filename300]);
    }
}
