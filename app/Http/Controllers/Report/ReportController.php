<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('permission:report-index')->only('index');
}

    public function index() {
        return view('super-admin.report', [
            '_active' => 'report'
        ]);
    }
}
