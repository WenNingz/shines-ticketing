<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function errorEmailToken() {
        return view('error.invalid-email-token');
    }
}
