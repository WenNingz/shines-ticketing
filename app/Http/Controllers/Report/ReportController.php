<?php

namespace App\Http\Controllers\Report;

use App\Event;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Excel;
use Illuminate\Support\Facades\Input;

class ReportController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('permission:report-index')->only('index');
        $this->middleware('permission:report-generate')->only('generate');
    }

    public function index() {
        $user = auth()->user();
        if (Input::get('start_date') == null) {
            $start_date = Carbon::now()->toDateString();
        } else {
            $start_date = Input::get('start_date');
        }

        if (Input::get('end_date') == null) {
            $end_date = Carbon::now()->toDateString();
        } else {
            $end_date = Input::get('end_date', Carbon::now());
        }

        switch (Input::get('type')) {
            default:
                $events = Event::where('date', '>=', $start_date)
                    ->where('date', '<=', $end_date)->get();
                break;
            case 'live':
                $events = Event::where('date', '>=', Carbon::now())
                    ->where('date', '<=', Carbon::parse(Input::get('end_date')))->get();
                break;
            case 'completed':
                $events = Event::where('date', '>=', $start_date)
                    ->where('date', '<=', Carbon::now())->get();
                break;
        }

        if ($user->hasRole('super-admin')) {
            return view('super-admin.report', [
                '_active' => 'report',
                'events' => $events,
                'start_date' => $start_date,
                'end_date' => $end_date
            ]);
        }
        if ($user->hasRole('admin')) {
            return view('admin.report', [
                '_active' => 'report',
                'events' => $events,
                'start_date' => $start_date,
                'end_date' => $end_date
            ]);
        }
    }

    public function generate(Request $request) {

        Excel::create('report_'. Carbon::now()->toDateString(), function ($excel) {
            $excel->sheet('Report', function ($sheet) {
                $sheet->setAutoSize(true);
                $sheet->row(1, [
                    'Event Name', 'Event Date', 'Sales', null, null, null
                ]);
                $sheet->row(2, [
                    null, null, 'Payment ID', 'Date', 'Ticket', null
                ]);
                $sheet->row(3, [
                    null, null, null, null, 'Type', 'Number'
                ]);

                $sheet->mergeCells('C1:F1');
                $sheet->mergeCells('E2:F2');
                $sheet->mergeCells('A1:A3');
                $sheet->mergeCells('B1:B3');
                $sheet->mergeCells('C2:C3');
                $sheet->mergeCells('D2:D3');

                $row = 4;

                switch (Input::get('type')) {
                    case 'all':
                        $events = Event::where('date', '>=', Carbon::parse(Input::get('start_date')))
                            ->where('date', '<=', Carbon::parse(Input::get('end_date')))->get();
                        break;
                    case 'live':
                        $events = Event::where('date', '>=', Carbon::now())
                            ->where('date', '<=', Carbon::parse(Input::get('end_date')))->get();
                        break;
                    case 'completed':
                        $events = Event::where('date', '>=', Carbon::parse(Input::get('start_date')))
                            ->where('date', '<=', Carbon::now())->get();
                        break;
                }

                foreach ($events as $event) {

                    $start_row1 = $row;
                    $have = false;

                    foreach ($event->purchases as $purchase) {

                        $start_row2 = $row;
                        $have = true;

                        foreach ($purchase->items as $item) {

                            $start_row3 = $row;

                            foreach ($item->passes as $pass) {
                                $sheet->row($row++, [
                                    $event->name, $event->date, $purchase->purchase_id, $purchase->created_at, $item->ticket->name, $pass->number
                                ]);
                            }

                            $sheet->mergeCells('E' . $start_row3 . ':E' . ($row - 1));
                        }

                        $sheet->mergeCells('C' . $start_row2 . ':C' . ($row - 1));
                        $sheet->mergeCells('D' . $start_row2 . ':D' . ($row - 1));
                    }
                    if ($have) {
                        $sheet->mergeCells('A' . $start_row1 . ':A' . ($row - 1));
                        $sheet->mergeCells('B' . $start_row1 . ':B' . ($row - 1));
                    } else {
                        $sheet->row($row++, [
                            $event->name, $event->date, 'No sales'
                        ]);
                        $sheet->mergeCells('C' . $start_row1 . ':F' . ($row - 1));
                    }
                }
            });
        })->download('xlsx');
    }
}
