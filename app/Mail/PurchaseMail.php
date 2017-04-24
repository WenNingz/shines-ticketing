<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use PDF;

class PurchaseMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function build() {
        $result = $this->view('email.purchase')->with([
            'event' =>$this->data['event'],
            'user' =>$this->data['user'],
            'purchase' =>$this->data['purchase'],
            'passes' =>$this->data['passes']
        ])->subject('Your Tickets for ' . $this->data['event']->name);

        $pdf = PDF::loadView('email.ticket', $this->data);

        $result = $result->attachData($pdf->output(), 'ticket.pdf', [
            'mime' => 'application/pdf',
        ]);

        return $result;
    }
}
